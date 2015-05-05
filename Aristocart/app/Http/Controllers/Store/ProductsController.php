<?php namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;		//Have to redefine where Controller is
use App\Models\Authenticate;
use Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Response;
use View;
use URL;

class ProductsController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Products Controller
	|--------------------------------------------------------------------------
	|
	| This controller shows the Products page, and handles the creation and edit of
	| products and their categories
	|
	*/
	public function index()
	{
		$role = Authenticate::checkRole();
		if(!$role){
			$role = 'customer';
		}
		return view('store/products')->with('role', $role);

	}

	public function addProduct(){
		return view('store/products');
	}
}