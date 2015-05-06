<?php namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;		//Have to redefine where Controller is
use App\Models\Category;
use App\Models\Authenticate;
use App\Models\Product;
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

		$categories = Category::getCategories();
		$data['selected_category'] = Request::input('selected_category');
		$data['categories'] = $categories;
		$data['role'] = $role;


		return view('store/products')->with('data', $data);

	}

	public function addProduct()
	{
		$productToAdd = new Product();
		$productToAdd->itemName = Request::input('name');
		$productToAdd->price = Request::input('price');
		$productToAdd->categoryId = Request::input('category');
		$productToAdd->skuNum = Request::input('sku');
		$errors = $productToAdd->addProduct();
		if(empty($errors)){
			$data['result'] = 'Successful';
		} else{
			$data['result'] = 'Failed';
		}
		$data['errors'] = $errors;
		return View::make('store/add-product-results')->with('data', $data);
	}

	public function updateProduct(){

	}
}