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
        $config          = config('instagram');
        $this->instagram = new Instagram($config);
    }

    public function getIndex()
    {
        return view('admin.index');
    }

    public function getToken()
    {
        $token = Token::orderBy('created_at', 'desc')->get();
        $data  = array(
            'authorize_link' => $this->instagram->getLoginUrl(array('basic', 'public_content')),
            'token'          => $token->toArray()
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
        $tag  = Tag::find($tag_id);
        $feed = Feed::where('tag_id', $tag_id)->orderBy('created_at', 'desc')->get()->toArray();

        $data = array(
            'tag'  => $tag,
            'feed' => $feed
        );

        return view('admin.archivetag', $data);
    }
}
