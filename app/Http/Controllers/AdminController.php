<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use App\Models\Token;
/**
 * Description of AdminController
 *
 * @author Keittirat
 */
class AdminController extends Controller {

	public function getIndex() {
		return view('admin.index');
	}
	
	public function getToken() {
		$token  = Token::get();
		return view('admin.token', array('token' => $token));
	}

	public function getHashtag() {
		return 'xxxx';
	}

}
