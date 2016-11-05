<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::get('/', 'AdminController@getIndex');
Route::get('/token', 'AdminController@getToken');
Route::get('/hashtag', 'AdminController@getHashtag');

Route::get('/operation/staff', 'OperationController@getIndex');
Route::get('/callback', 'OperationController@getCallback');
Route::get('/operation/disable-token', 'OperationController@getDisbleToken');
Route::get('/operation/test', 'OperationController@getTest');
