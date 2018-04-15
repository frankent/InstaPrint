<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Libraries\Instagram;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Tag;
use App\Models\Token;
use App\Models\Feed;

use Imagick;
use ImagickDraw;

/**
 * Description of OperationController
 *
 * @author keittirat.sat
 */
class OperationController extends Controller
{

    private $instagram;

    public function __construct()
    {
        $config          = config('instagram');
        $this->instagram = new Instagram($config);
    }

    public function getIndex()
    {
        return ['url' => $this->instagram->getLoginUrl(array('basic'))];
    }

    public function getCallback()
    {
        $code = Input::get('code');
        $resp = $this->instagram->getAccessToken($code);

        if ($resp == false) {
            return redirect()->action('AdminController@getLogin')->with('status', 'token_error');
        }

        Log::info($resp);

        $token            = new Token;
        $token->name      = $resp['user']['full_name'];
        $token->token     = $resp['access_token'];
        $token->is_active = true;
        $token->picture   = $resp['user']['profile_picture'];
        $token->save();

        return redirect()->action('AdminController@getLogin')->with('status', 'token_add_success');
    }

    public function getDisbleToken()
    {
        $token_id         = Input::get('id');
        $token            = Token::find($token_id);
        $token->is_active = false;
        $token->save();
        return redirect()->action('AdminController@getToken')->with('status', 'token_disabled_success');
    }

    public function postHashtag()
    {
        $hash_tag = Input::get('hash_tag');
        $data     = array(
            'hash_tag' => 'required|unique:tag,name'
        );

        $validate = Validator::make(array('hash_tag' => $hash_tag), $data);
        if ($validate->fails()) {
            return redirect()->action('AdminController@getHashtag')->with('status', array('state' => false, 'msg' => $validate->messages()->first()));
        }

        $tag            = new Tag;
        $tag->name      = $hash_tag;
        $tag->is_active = true;
        $tag->save();

        return redirect()->action('AdminController@getHashtag')->with('status', array('state' => true, 'msg' => 'ระบบได้เพิ่ม Hash Tag เข้าระบบแล้ว'));
    }

    public function postHashtagStatus()
    {
        $tag_status = Input::get('tag_status');
        $tag_status = json_decode($tag_status, true);

        if (empty($tag_status)) {
            return redirect()->action('AdminController@getHashtag')->with('status', array('state' => false, 'msg' => 'ไม่พบข้อมูลอัพเดต'));
        }

        foreach ($tag_status as $each_tag) {
            $tag            = Tag::find($each_tag['tag_id']);
            $tag->is_active = (int) $each_tag['is_active'];
            $tag->save();
        }

        return redirect()->action('AdminController@getHashtag')->with('status', array('state' => true, 'msg' => 'ระบบอัพเดตสถานะ Hash Tag เรียบร้อยแล้ว'));
    }

    public function getMedia()
    {
//        $alive_token = Token::where('is_active', true)->get()->toArray();
//
//        if (empty($alive_token)) {
//            return false;
//        }
//
//        $token        = $alive_token[array_rand($alive_token)];
//        $access_token = $token['token'];
//        $user_info    = $this->instagram->getUserInfo($access_token);
//        if ($user_info == false) {
//            $current_token            = Token::find($token['id']);
//            $current_token->is_active = false;
//            $current_token->save();
//        }

        $all_tags = Tag::where('is_active', true)->get()->toArray();
        foreach ($all_tags as $tag) {
            $hash_tag = $tag['name'];
//            $feed     = $this->instagram->getHashTagMedia($hash_tag, $access_token);
            $feed     = $this->instagram->getPublicHashTag($hash_tag);

            if (!empty($feed)) {
                foreach ($feed as $post) {
                    $validate = Validator::make(array('post_id' => $post['id']), array('post_id' => 'required|unique:feed,post_id,NULL,id,tag_id,' . $tag['id']));
                    if ($validate->passes() && $post['is_video'] === false) {

                        $userProfile = $this->instagram->getPublicUserProfile($post['shortcode']);

                        $feed_post                = new Feed;
                        $feed_post->picture_s     = $post['images']['thumbnail']['url'];
                        $feed_post->picture_m     = $post['images']['low_resolution']['url'];
                        $feed_post->picture_l     = $post['images']['standard_resolution']['url'];
                        $feed_post->name          = $userProfile['graphql']['shortcode_media']['owner']['full_name'];
                        $feed_post->profile_pic   = $userProfile['graphql']['shortcode_media']['owner']['profile_pic_url'];
                        $feed_post->caption       = empty($post['caption']) ? null : array_get($post['caption'], 'text');
                        $feed_post->post_id       = $post['id'];
                        $feed_post->tag_id        = $tag['id'];
                        $feed_post->status        = 'new';
                        $feed_post->post_location = empty($userProfile['graphql']['shortcode_media']['location']) ? null : $userProfile['graphql']['shortcode_media']['location']['name'];
                        $feed_post->save();

                        // create image
                        $this->createImage([
                            'id' => $post['id'],
                            'img_url' => $post['images']['low_resolution']['url'],
                            'caption' => empty($post['caption']) ? null : array_get($post['caption'], 'text'),
                            'username' => $userProfile['graphql']['shortcode_media']['owner']['full_name'],
                            'profile_pic' => $userProfile['graphql']['shortcode_media']['owner']['profile_pic_url']
                        ]);
                    }
                }
            }
        }

        return true;
    }

    public function getOwnMedia()
    {
        $alive_token = Token::where('is_active', true)->get()->toArray();
        foreach ($alive_token as $token) {
            $access_token = $token['token'];
            $user_info    = $this->instagram->getUserInfo($access_token);
            if ($user_info == false) {
                $current_token            = Token::find($token['id']);
                $current_token->is_active = false;
                $current_token->save();
            }

            $all_tags = Tag::where('is_active', true)->get()->toArray();
            $feed = $this->instagram->getOwnFeedMedia($access_token);
            if ($feed != false) {
                foreach ($feed['data'] as $post) {
                    foreach ($all_tags as $tag) {
                        $hash_tag = $tag['name'];
                        if (in_array($hash_tag, $post['tags']) && $post['type'] == 'image') {
                            $validate = Validator::make(array('post_id' => $post['id']), array('post_id' => 'required|unique:feed,post_id,NULL,id,tag_id,' . $tag['id']));
                            if ($validate->passes()) {
                                $feed_post                = new Feed;
                                $feed_post->picture_s     = $post['images']['thumbnail']['url'];
                                $feed_post->picture_m     = $post['images']['low_resolution']['url'];
                                $feed_post->picture_l     = $post['images']['standard_resolution']['url'];
                                $feed_post->name          = $post['user']['full_name'];
                                $feed_post->profile_pic   = $post['user']['profile_picture'];
                                $feed_post->caption       = empty($post['caption']) ? null : array_get($post['caption'], 'text');
                                $feed_post->post_id       = $post['id'];
                                $feed_post->tag_id        = $tag['id'];
                                $feed_post->status        = 'new';
                                $feed_post->post_location = empty($post['location']) ? null : array_get($post['location'], 'name');
                                $feed_post->save();

                                // create image
                                $this->createImage([
                                    'id' => $post['id'],
                                    'img_url' => $post['images']['standard_resolution']['url'],
                                    'caption' => empty($post['caption']) ? null : array_get($post['caption'], 'text'),
                                    'username' => $post['user']['full_name'],
                                    'profile_pic' => $post['user']['profile_picture']
                                ]);
                            }
                        }
                    }
                }
            }
        }

        return true;
    }

    private function createImage($data)
    {
        $id = $data['id'];
        $img_url = $data['img_url'];
        $username = $data['username'];
        $save_path = public_path("image/{$id}.jpg");
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

//        echo PHP_EOL . "Process Post Ids: {$id} by {$username}" . PHP_EOL;

//        echo "Getting Post Picture" . PHP_EOL;
        $post_blob = file_get_contents($img_url, false, stream_context_create($arrContextOptions));
        $mask_layer = file_get_contents(public_path('img/mask_layer.png'), false);

        /**
         * Imagick operate
         */
//        echo "Creating image" . PHP_EOL;

        $frame = new Imagick();
        $frame->newimage(1200, 1800, "#ffffff");

        $post_imagick = new Imagick();
        $post_imagick->readimageblob($post_blob);
        $post_imagick->scaleimage(1050, 1050, 1);
        $post_imagick->getImageGeometry();

        $mask_layer_imagick = new Imagick();
        $mask_layer_imagick->readImageBlob($mask_layer);
        $mask_layer_imagick->resizeImage(1200, 1800, Imagick::FILTER_CATROM, 1);

        $frame->compositeimage($post_imagick, Imagick::COMPOSITE_DEFAULT, 75, 165);
        $frame->compositeimage($mask_layer_imagick, Imagick::COMPOSITE_DEFAULT, 0, 0);

        $frame->writeimage($save_path);

        $frame->destroy();
        $post_imagick->destroy();
        $mask_layer_imagick->destroy();

//        echo "Save image to: {$save_path}" . PHP_EOL;
    }

    public function printImage() {
//        $script_path = public_path('../print_script.sh');
//        if (!file_exists($script_path)) {
            $newImage = Feed::where('status', 'new')->orderBy('id', 'asc')->limit(1)->get()->toArray();

            $shellScript = '';
//            $shellScript = '#!/bin/bash' . PHP_EOL;
            $ids = array();
            foreach ($newImage as $eachPost) {
                $ids[] = $eachPost['id'];
                $path = 'public/image/' . $eachPost['post_id'] . '.jpg';

//                echo 'process instaxId: ' . $eachPost['id'] . ' @ ' . $eachPost['post_id'] . PHP_EOL;

                $shellScript = "lp -d Canon_G2000_series -o fit-to-page {$path}" . PHP_EOL;
            }
//            $shellScript .= 'rm print_script.sh';

//            file_put_contents($script_path, $shellScript);

            Feed::whereIn('id', $ids)->update(['status' => 'processed']);
            echo $shellScript;
//        } else {
//            echo 'skip - found print script still on processing' . PHP_EOL;
//        }
    }
}
