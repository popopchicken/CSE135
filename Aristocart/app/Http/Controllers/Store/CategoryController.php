<?php namespace App\Http\Controllers\Store;	//For subfolders use the proper namespace

use App\Http\Controllers\Controller;		//Have to redefine where Controller is
use App\HTTP\Requests\LoginFormRequest;
use Response;
use View;

class CategoryController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Category Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the Category page, and allows the owners to 
	| create new categories, but hides the input for customers.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the sign up screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('store/categories');
	}

	public function addCategories()
	{
		return view('store/categories');
	}

}