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
        return ['url' => $this->instagram->getLoginUrl(array('basic', 'public_content'))];
    }

    public function getCallback()
    {
        $code = Input::get('code');
        $resp = $this->instagram->getAccessToken($code);

        if ($resp == false) {
            return redirect()->action('AdminController@getToken')->with('status', 'token_error');
        }

        Log::info($resp);

        $token            = new Token;
        $token->name      = $resp['user']['full_name'];
        $token->token     = $resp['access_token'];
        $token->is_active = true;
        $token->picture   = $resp['user']['profile_picture'];
        $token->save();

        return redirect()->action('AdminController@getToken')->with('status', 'token_add_success');
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
            $tag = Tag::find($each_tag['tag_id']);
            $tag->is_active = (int) $each_tag['is_active'];
            $tag->save();
        }
        
        return redirect()->action('AdminController@getHashtag')->with('status', array('state' => true, 'msg' => 'ระบบอัพเดตสถานะ Hash Tag เรียบร้อยแล้ว'));
    }
}
