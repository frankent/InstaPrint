<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Models\Token;
use App\Libraries\Instagram;
use App\Models\Tag;
use App\Models\Feed;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

/**
 * Description of AdminController
 *
 * @author Keittirat
 */
class AdminController extends Controller
{

    private $instagram;

    public function __construct()
    {
        $config = config('instagram');
        $this->instagram = new Instagram($config);
    }

    public function getLogin()
    {
        $token = Token::where('is_active', 1)->orderBy('created_at', 'desc')->get();
        $data = array(
            'authorize_link' => $this->instagram->getLoginUrl(array('basic')),
            'token' => $token->toArray()
        );

        return view('carousel.login', $data);
    }

    public function getIndex()
    {
        $hash_tag = Tag::where('is_active', true)->orderBy('created_at', 'desc')->get()->toArray();
        foreach ($hash_tag as &$each_tag) {
            $each_tag['total_feed'] = Feed::where('tag_id', $each_tag['id'])->count();
        }

        $data = array(
            'tag' => $hash_tag
        );

        return view('admin.dashboard', $data);
    }

    public function getToken()
    {
        $token = Token::orderBy('created_at', 'desc')->get();
        $data = array(
            'authorize_link' => $this->instagram->getLoginUrl(array('basic')),
            'token' => $token->toArray()
        );
        return view('admin.token', $data);
    }

    public function getHashtag()
    {
        $hash_tag = Tag::orderBy('created_at', 'desc')->get()->toArray();
        foreach ($hash_tag as &$each_tag) {
            $each_tag['total_feed'] = Feed::where('tag_id', $each_tag['id'])->count();
        }

        $data = array(
            'tag' => $hash_tag
        );

        return view('admin.hashtag', $data);
    }

    public function getFeed($tag_id)
    {
        $tag = Tag::find($tag_id);
        $feed = Feed::where('tag_id', $tag_id)->orderBy('created_at', 'desc')->paginate(30)->toArray();
        $data = array(
            'tag' => $tag,
            'pagination' => array(
                'prev_page_url' => $feed['prev_page_url'],
                'next_page_url' => $feed['next_page_url'],
                'current_page' => $feed['current_page'],
                'last_page' => $feed['last_page']
            ),
            'feed' => $feed['data']
        );

        return view('admin.archivetag', $data);
    }

    public function getCarousel($tag_id)
    {

        $tag_info = Tag::select('name')->find($tag_id)->toArray();

        $data = [
            'tag_id' => $tag_id,
            'tag_name' => array_get($tag_info, 'name'),
            'next_feed' => action('AdminController@getMoreCorousel', array('segment' => 0, 'tag_id' => $tag_id)),
        ];

        return view('carousel.feed', $data);
    }

    public function getMoreCorousel()
    {
        $segment = Input::get('segment', 0);
        $tag_id = Input::get('tag_id');
        $feed = Feed::select('id', 'picture_s as thumb', 'picture_l', 'name', 'post_location', 'caption', 'profile_pic', 'post_id')
            ->where('tag_id', $tag_id)
            ->where('id', '>', $segment)
            ->limit(30)
            ->get();


        if (count($feed)) {
            $data = [
                'tag_id' => $tag_id,
                'next_feed' => action('AdminController@getMoreCorousel', array('segment' => $feed[count($feed) - 1]->id, 'tag_id' => $tag_id)),
                'feed' => $feed->toArray()
            ];
        } else {
            $data = [
                'tag_id' => $tag_id,
                'next_feed' => action('AdminController@getMoreCorousel', array('segment' => $segment, 'tag_id' => $tag_id)),
                'feed' => []
            ];
        }

        return $data;
    }
}
