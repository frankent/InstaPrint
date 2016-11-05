<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Models\Token;
use App\Libraries\Instagram;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

/**
 * Description of AdminController
 *
 * @author Keittirat
 */
class AdminController extends Controller {

	private $instagram;

	public function __construct() {
		$config			 = config('instagram');
		$this->instagram = new Instagram($config);
	}

	public function getIndex() {
		return view('admin.index');
	}

	public function getToken() {
		$token	 = Token::orderBy('created_at', 'desc')->get();
		$data	 = array(
			'authorize_link' => $this->instagram->getLoginUrl(array('basic', 'public_content')),
			'token'			 => $token->toArray()
		);
		return view('admin.token', $data);
	}

	public function getHashtag() {
		return 'xxxx';
	}

}
