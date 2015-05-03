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
Route::post('sign-up', 'SignUpController@signUp');
Route::get('/', 'LoginController@index');
Route::get('login', 'LoginController@index');
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');
//Route::post('store/product-browsing', ProductBrowsingController)

$router->get('store/categories', 'Store\CategoryController@index');	//Must use this for subfolders (Look at CategoryController for more config)
<<<<<<< HEAD
$router->post('store/categories', 'Store\CategoryController@addCategory');	//Must use this for subfolders
//$router->get('store/product_browsing', 'Store\ProductBrowsingController@index');
=======
$router->post('store/categories', 'Store\CategoryController@addCategories');	//Must use this for subfolders

>>>>>>> a8d55e08d1cde88e3db534ebc223ff1e4c695755

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
