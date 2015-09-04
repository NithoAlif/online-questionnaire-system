<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

Route::controllers([
    'password' => 'Auth\PasswordController',
]);

// Authenticated Users only!
Route::group(['middleware' => 'auth'], function() {
	Route::get('admin', function () {
	    return view('layouts\admin_template');
	});
});

// Test
Route::get('builder', function() {
	return view('builder');
});
Route::post('builder', 'QuestionnaireController@inputForm');