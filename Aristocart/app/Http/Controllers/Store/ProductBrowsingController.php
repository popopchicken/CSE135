<?php namespace App\Http\Controllers\Store;	//For subfolders use the proper namespace

use App\Http\Controllers\Controller;		//Have to redefine where Controller is
use App\Models\Authenticate;
use App\Models\Product;
use App\Models\Category;
use App\HTTP\Requests\LoginFormRequest;
use Response;
use Request;
use View;

class ProductBrowsingController extends Controller {

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
	 * Show the sign up screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = self::loadPreliminaryValues();
		return view('store/product-browsing')->with('data', $data);
	}


	public function selectAction(){
		$data = self::loadPreliminaryValues();

		switch (Request::input('action')){
			case "search":
				$data['products'] = self::search();
				return view('store/product-browsing')->with('data', $data);
				break;
			case "add-to-cart":
				$data['productId'] = Request::input('productId');
				$data['price'] = Request::input('price');
				return view('store/product-order')->with('data', $data);
				break;
		}
		return redirect('store/product-browsing')->with('data', $data);
	}

	public function addProductToCart(){
		return view('store/product-order');
	}


	private function loadPreliminaryValues(){
		$role = Authenticate::checkRole();
		$products = array();
		$categories = Category::getCategories();

		self::getCategoryId();
		if($this->selectedCategory == -1){
			$data['all_categories'] = 1;
			$data['selected_category'] = 0;
		} else{
			$data['all_categories'] = 0;
			$data['selected_category'] = $this->selectedCategory;
		}
		$products = Product::getProductsByCategoryId($this->selectedCategory);

		$data['categories'] = $categories;
		$data['role'] = $role;
		$data['products'] = $products;
		return $data;
	}

	private function getCategoryId(){
		$this->selectedCategory = Request::input('selected_category');
		if(!$this->selectedCategory){
			$this->selectedCategory = -1;
		}
	}

	public function search(){
		$productToSearch = new Product();
		$productToSearch->itemName = Request::input('search');
		$productToSearch->categoryId = $this->selectedCategory;
		$products = $productToSearch->searchForProduct();
		return $products;
	}

}