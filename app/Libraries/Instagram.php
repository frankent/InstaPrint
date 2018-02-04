<?php

namespace App\Libraries;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class Instagram
{

    /**
     * The API base URL
     */
    const API_URL = 'https://api.instagram.com/v1/';

    /**
     * The API OAuth URL
     */
    const API_OAUTH_URL = 'https://api.instagram.com/oauth/authorize';

    /**
     * The OAuth token URL
     */
    const API_OAUTH_TOKEN_URL = 'https://api.instagram.com/oauth/access_token';

    private $_apikey;
    private $_apisecret;
    private $_apicallback;
    private $_scope = array('basic', 'public_content', 'follower_list', 'likes', 'comments', 'relationships');

    public function __construct($option = array())
    {
        $this->_apikey      = array_get($option, 'apiKey');
        $this->_apisecret   = array_get($option, 'apiSecret');
        $this->_apicallback = array_get($option, 'apiCallback');
    }

    private function postArray($url, $param = array())
    {
        try {
            $client   = new Client();
            $response = $client->request('POST', $url, array(
                'verify'      => false,
                'form_params' => $param
            ));

            $resp = $response->getBody()->getContents();
            return json_decode($resp, true);
        } catch (RequestException $e) {
            $str_log = '[' . date('Y-m-d H:i:s') . '] ' . $e->getCode() . ' ' . $e->getMessage();
            Log::error($str_log);
        }

        return false;
    }

    private function getRequest($url)
    {
        try {
            $client   = new Client();
            $response = $client->request('GET', $url, array(
                'verify' => false
            ));

            $resp = $response->getBody()->getContents();
            return json_decode($resp, true);
        } catch (RequestException $e) {
            $str_log = '[' . date('Y-m-d H:i:s') . '] ' . $e->getCode() . ' ' . $e->getMessage();
            Log::error($str_log);
        }
    }

    public function getLoginUrl($scope = array('basic'))
    {
        $scope = !is_array($scope) ? array('basic') : $scope;
        $scope = array_intersect($this->_scope, $scope);

        $get_data = array(
            'client_id'     => $this->_apikey,
            'redirect_uri'  => $this->_apicallback,
            'scope'         => implode(' ', $scope),
            'response_type' => 'code'
        );

        return self::API_OAUTH_URL . '?' . http_build_query($get_data);
    }

    public function getAccessToken($code)
    {
        $param = array(
            'client_id'     => $this->_apikey,
            'client_secret' => $this->_apisecret,
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'redirect_uri'  => $this->_apicallback
        );

        return self::postArray(self::API_OAUTH_TOKEN_URL, $param);
    }

    public function getUserInfo($access_token)
    {
        $url = 'https://api.instagram.com/v1/users/self/?access_token=' . $access_token;
        return self::getRequest($url);
    }

    public function getHashTagMedia($hash_tag, $access_token)
    {
        # $url = 'https://api.instagram.com/v1/tags/' . $hash_tag . '/media/recent?access_token=' . $access_token;
        # return self::getRequest($url);
        # Initial Feed

        $feedInScope = [];
        $timeInfocus = date('U') - 86400; // Focus only 1 day
        $shouldGoToNextPage = true;
        $nextPageLink = null;

        do {
            $recentFeed = $nextPageLink ? self::getRequest($nextPageLink) : self::getOwnFeedMedia($access_token);
            $nextPageLink = $recentFeed['pagination']['next_url'];
            foreach ($recentFeed['data'] as $eachPost) {
                if (!empty($eachPost['caption']) && preg_match('/(#' . $hash_tag . ')/', $eachPost['caption']) && $eachPost['created_time'] > $timeInfocus) {
                    $feedInScope[] = $eachPost;
                } else if ($eachPost['created_time'] <= $timeInfocus) {
                    $shouldGoToNextPage = false;
                }
            }

        } while($shouldGoToNextPage);

        return $feedInScope;
    }

    public function getPublicHashTag($hash_tag) {

        $timeInfocus = date('U') - 86400; // Focus only 1 day
        $url = 'https://www.instagram.com/explore/tags/' . $hash_tag . '/?__a=1';

        // $nextPage = 'https://www.instagram.com/graphql/query/?query_hash=298b92c8d7cad703f7565aa892ede943&variables={%22tag_name%22:%22thailand%22,%22first%22:2,%22after%22:%22J0HWnYlHgAAAF0HWnYjpgAAAFnIA%22}'

        $feedData = self::getRequest($url);

        $feedMedia = $feedData['graphql']['hashtag']['edge_hashtag_to_media'];

//        $total = $feedMedia['count'];
        $allData = $feedMedia['edges'];
//        $pagination = $feedMedia['page_info'];
        $feedInFocus = [];

        foreach ($allData as $post) {
            $postData = $post['node'];
            if ($postData['taken_at_timestamp'] >= $timeInfocus) {
                $feedInFocus[] = [
                    'id' => $postData['id'],
                    'images' => [
                        'thumbnail' => [
                            'url' => $postData['thumbnail_resources'][0]['src']
                        ],
                        'low_resolution' => [
                            'url' => $postData['thumbnail_src']
                        ],
                        'standard_resolution' => [
                            'url' => $postData['display_url']
                        ]
                    ],
                    'user' => [
                        'full_name' => '',
                        'profile_picture' => ''
                    ],
                    'caption' => $postData['edge_media_to_caption']['edges'][0]['node']['text'],
                    'location' => '',
                    'is_video' => $postData['is_video'],
                    'shortcode' => $postData['shortcode'],
                ];
            }
        }

        return $feedInFocus;
    }

    public function getPublicUserProfile($shortcode) {
        $userUrl = 'https://www.instagram.com/p/' . $shortcode . '/?__a=1';
        return self::getRequest($userUrl);
    }

    public function getOwnFeedMedia($access_token)
    {
        $url = 'https://api.instagram.com/v1/users/self/media/recent?access_token=' . $access_token;
        return self::getRequest($url);
    }
}
