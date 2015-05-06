<?php namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;		//Have to redefine where Controller is
use App\Models\Category;
use App\Models\Authenticate;
use App\Models\Product;
use Request;
use Session;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Response;
use View;
use URL;

class ProductsController extends Controller {
	public $selectedCategory;
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
		if(!Session::get('user_id')){
			return redirect('access-denied');
		}
		$data = self::setPreliminaryValues();
		return view('store/products')->with('data', $data);
	}

	public function selectAction(){
		$data = self::setPreliminaryValues();

		switch (Request::input('action')){
			case "search":
				$data['products'] = self::search();
				return view('store/products')->with('data', $data);
				break;
			case "search-browse":

				break;
			case "addProduct":
				$data['errors'] = self::addProduct();
				if(empty($data['errors'])){
					$data['result'] = 'Successful';
				} else{
					$data['result'] = 'Failed';
				}

				return View::make('store/add-product-results')->with('data', $data);
				break;
			case "update":
				$data['errors'] = self::updateProduct();
				break;
			case "delete":
				$data['errors'] = self::deleteProduct();
				break;
		}

		//TODO: Add necessary data
		return redirect('store/products')->with('data', $data);
	}

	public function addProduct()
	{
		$productToAdd = new Product();
		$productToAdd->itemName = Request::input('name');
		$productToAdd->price = Request::input('price');
		$productToAdd->categoryId = Request::input('category');
		$productToAdd->skuNum = Request::input('sku');
		$errors = $productToAdd->addProduct();
		return $errors;
	}

	public function updateProduct(){
		$productToUpdate = new Product();
		$productToUpdate->productId = Request::input('productId');
		$productToUpdate->itemName = Request::input('name');
		$productToUpdate->skuNum = Request::input('sku');
		$productToUpdate->price = Request::input('price');
		$productToUpdate->categoryId = Request::input('category');
		$productToUpdate->updateProduct();
		$errors = $productToUpdate->updateProduct();
		return $errors;
	}

	public function search(){
		$productToSearch = new Product();
		$productToSearch->itemName = Request::input('search');
		$productToSearch->categoryId = $this->selectedCategory;
		$products = $productToSearch->searchForProduct();
		return $products;
	}

	public function deleteProduct(){
		$productToDelete = new Product();
		$productToDelete->productId = Request::input('productId');
		$errors = $productToDelete->deleteProduct();
		return $errors;
	}

	private function getCategoryId(){
		$this->selectedCategory = Request::input('selected_category');
		if(!$this->selectedCategory){
			$this->selectedCategory = -1;
		}
	}

	private function setPreliminaryValues(){
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
		$data['count'] = 0;
		return $data;
	}
}