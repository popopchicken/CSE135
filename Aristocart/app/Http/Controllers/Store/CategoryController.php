<?php namespace App\Http\Controllers\Store;	//For subfolders use the proper namespace

use Request;
use App\Models\Category;
use App\Http\Controllers\Controller;		//Have to redefine where Controller is
use App\Models\Authenticate;
use Illuminate\Http\RedirectResponse;
use App\HTTP\Requests\LoginFormRequest;
use Response;
use View;
use URL;
use Auth;

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
		Authenticate::checkExpiredLogin();
		return view('store/categories');
	}

	public function addCategories()
	{
		$name = Request::input('cat_name');
		$description = Request::input('cat_description');
		//$id = Auth::id();

		$category = new Category();
		$category->cat_name = $name;
		$category->cat_description = $description;
		//$category->userID = $id;

		if(is_null($name) || is_null($description)){
			return view('store/categories');
		}
		else{
			$category->addCategory();
			return view('store/categories');
		}


		return view('store/categories');
	}

}