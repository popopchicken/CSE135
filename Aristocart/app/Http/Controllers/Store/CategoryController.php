<?php namespace App\Http\Controllers\Store;	//For subfolders use the proper namespace

use Request;
use App\Models\Category;
use App\Http\Controllers\Controller;		//Have to redefine where Controller is
use App\Models\Authenticate;
use Illuminate\Http\RedirectResponse;
use App\HTTP\Requests\LoginFormRequest;
use Response;
use Session;
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
		$data = self::setPreliminaryValues();

		/*Authenticate::checkExpiredLogin();
		$categories = Category::showCategories();*/
		return View::make('store/categories')->with('data', $data);
	}

	public function setPreliminaryValues()
	{
		if(!Session::get('user_id')){
			return redirect('access-denied');
		}
		Authenticate::checkExpiredLogin();
		$role = Authenticate::checkRole();
		$categories = array();
		$products = array();
		$cats = array();

		$categories = Category::showCategories();
		$products = Category::allCatsWithProducts();
		foreach($categories as $cat){
			foreach($products as $prod){
				if($prod->category_id == $cat->id){
					$cats[$cat->id] = $cat->name;
				}	
			}
		}
		$data = Session::get('data');
		$data['hasProducts'] = $cats;
		$data['categories'] = $categories;
		$data['role'] = $role;
		$data['catsWithProducts'] = $products;

		return $data;
	}

	public function selectAction()
	{
		$data = self::setPreliminaryValues();

		switch (Request::input('action')){
			case "addCategory":
				$data['errors'] = self::addCategories();
				if(empty($data['errors'])){
					$data['result'] = "Addition Successful";
				}
				else {
					$data['result'] = "Failure to Add Category";
				}

				//return View::make('store/categories')->with('data', $data);
				return Redirect::to('store/categories')->with('data', $data);
				break;
			case "deleteCategory":
				$data['errors'] = self::deleteCategories();
				//$data['hasProducts'] = Category::hasProducts();
				return Redirect::to('store/categories')->with('data', $data);
				break;
			case "updateCategory":
				$data['errors'] = self::updateCategories();
				return Redirect::to('store/categories')->with('data', $data);
				//Redirect::back()->with('data', $data);
				break;
		}

		//$data = Session::get('data');
		return View::make('store/categories')->with('data', $data);
	}

	public function addCategories()
	{
		$name = Request::input('cat_name');
		$description = Request::input('cat_description');

		$categoryToAdd = new Category();
		$categoryToAdd->cat_name = $name;
		$categoryToAdd->cat_description = $description;

		$message = $categoryToAdd->addCategory();
		return $message;

	}

	public function deleteCategories()
	{
		$categoryToDelete = new Category();
		$categoryToDelete->cat_name = Request::input('cat_name');
		$categoryToDelete->cat_id = Request::input('cat_id');
		$message = $categoryToDelete->deleteCategory();
		return $message;
	}

	public function updateCategories()
	{
		$categoryToUpdate = new Category();
		$categoryToUpdate->cat_name = Request::input('cat_name');
		$categoryToUpdate->cat_description = Request::input('cat_description');
		$categoryToUpdate->cat_id = Request::input('cat_id');
		$message = $categoryToUpdate->updateCategory();
		return $message;
	}

}