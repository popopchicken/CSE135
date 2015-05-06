<?php namespace App\Http\Controllers\Store;	//For subfolders use the proper namespace

use App\Http\Controllers\Controller;		//Have to redefine where Controller is
use App\Models\Authenticate;
use App\Models\Product;
use App\Models\Category;
use App\Models\ShoppingCart;
use App\HTTP\Requests\LoginFormRequest;
use Response;
use Session;
use Redirect;
use View;

class ProductOrderController extends Controller {

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
		return view('store/product-order')->with('data', $data);
	}

	public function addProductToCart(){
		$data = self::loadPreliminaryValues();
		$newProduct = Product::getProductById(Request::input('productId'));
		return view('store/product-order');
	}

	public function addCategories()
	{
		return view('store/categories');
	}

	private function loadPreliminaryValues(){
		$role = Authenticate::checkRole();
		if(Session::get('user_id') < 0){
			redirect('login');
		}
		$shoppingCart = new ShoppingCart();
		$shoppingCart->userId = Session::get('user_id');
		$shoppingCart->checkHasCart();
		$shoppingCart->getActiveCart();
		$products = $shoppingCart->doesCartHaveItems();
		$data['products'] = $products;
		$data['cart_total'] = $shoppingCart->cartTotal;
		$data['new_item']['price'] = '';
		$data['new_item']['name'] = '';
		$data['new_item']['productId'] = '';
		return $data;
	}

}