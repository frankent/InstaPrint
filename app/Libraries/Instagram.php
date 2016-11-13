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
        $url = 'https://api.instagram.com/v1/tags/' . $hash_tag . '/media/recent?access_token=' . $access_token;
        return self::getRequest($url);
    }

    public function getOwnFeedMedia($access_token)
    {
        $url = 'https://api.instagram.com/v1/users/self/media/recent?access_token=' . $access_token;
        return self::getRequest($url);
    }
}
