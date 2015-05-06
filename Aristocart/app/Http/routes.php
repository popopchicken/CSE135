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
Route::get('access-denied', function(){
	return view('access-denied');
});
//Route::post('store/product-browsing', ProductBrowsingController)

$router->get('store/categories', 'Store\CategoryController@index');	//Must use this for subfolders (Look at CategoryController for more config)
$router->post('store/categories', 'Store\CategoryController@selectAction');	//Must use this for subfolders
//$router->post('store/categories', 'Store\CategoryController@addCategories');	//Must use this for subfolders$router->delete('store/categories', 'Store\CategoryController@deleteCategories');
//$router->delete('store/categories', 'Store\CategoryController@deleteCategories');
//Route::delete('store/categories/{$name}', array('uses' => 'CategoryController@deleteCategories', 'as' => 'store/categories'))

$router->get('store/products', 'Store\ProductsController@index');
$router->post('store/products', 'Store\ProductsController@selectAction');

$router->get('store/product-browsing', 'Store\ProductBrowsingController@index');
$router->post('store/product-browsing', 'Store\ProductBrowsingController@selectAction');

$router->get('store/product-order', 'Store\ProductOrderController@index');
$router->post('store/product-order', 'Store\ProductOrderController@selectAction');

$router->get('store/buy-shopping-cart', 'Store\BuyShoppingCartController@index');
$router->post('store/buy-shopping-cart', 'Store\BuyShoppingCartController@buyCart');

$router->get('store/confirmation-page', 'Store\BuyShoppingCartController@confirmPage');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
