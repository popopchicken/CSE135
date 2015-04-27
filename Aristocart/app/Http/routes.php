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

//Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');

Route::get('sign-up', 'SignUpController@index');
Route::post('sign-up', 'LoginController@signUp');
Route::get('/', 'LoginController@index');
Route::get('login', 'LoginController@index');
Route::post('login', 'LoginController@login');

$router->get('store/categories', 'Store\CategoryController@index');	//Must use this for subfolders (Look at CategoryController for more config)
$router->post('store/categories', 'Store\CategoryController@addCategory');	//Must use this for subfolders


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
