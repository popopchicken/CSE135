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
use Redirect;
use DB;

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
		$categories = Category::showCategories();
		return View::make('store/categories')->with('categories', $categories);
	}

	public function addCategories()
	{
		$name = Request::input('cat_name');
		$description = Request::input('cat_description');

		$category = new Category();
		$category->cat_name = $name;
		$category->cat_description = $description;

		$duplicate = $category->checkDuplicate();
		if($duplicate){
			$message = "Category already exists";
			return Redirect::back()->with('message', $message);
		}
		if(is_null($name) || is_null($description)){
			return Redirect::back()->with('message','Addition Unsuccessful! Please enter a category name and/or description.');
		}
		else{
			$category->addCategory();
			return Redirect::back()->with('message','Addition Successful !');
			//return View::make('store/categories');
		}
	}

	public function deleteCategories()
	{
		
	}

}