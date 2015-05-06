<?php namespace App\Http\Controllers\Store;	//For subfolders use the proper namespace

use App\Http\Controllers\Controller;		//Have to redefine where Controller is
use App\Models\Authenticate;
use App\Models\Product;
use App\Models\Category;
use App\Models\ShoppingCart;
use App\HTTP\Requests\LoginFormRequest;
use Response;
use Request;
use Session;
use Redirect;
use View;

class ProductOrderController extends Controller {
	public $shoppingCart;

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
		if(!Session::get('user_id')){
			return redirect('access-denied');
		}
		$data = self::loadPreliminaryValues();
		return view('store/product-order')->with('data', $data);
	}
	public function selectAction(){
		$data = self::loadPreliminaryValues();
		switch (Request::input('action')){
			case "add-to-cart":
				$data['price'] = Request::input('price');
				$data = array_merge($data, self::addProductToCart());
				return view('store/product-order')->with('data', $data);
				break;
			case "confirm-add":
				$this->shoppingCart->addProductToCart(Request::input('productId'), Request::input('quantity'), Request::input('price'));
				return redirect('store/product-browsing');
				break;
		}
		return view('store/product-order')->with('data', $data);
	}
	public function addProductToCart(){
		$newProduct = Product::getProductById(Request::input('productId'));
		$data['new_item']['name'] = $newProduct[0]->name;
		$data['new_item']['price'] = $newProduct[0]->price;
		$data['new_item']['productId'] =  $newProduct[0]->id;
		return $data;
	}

	private function loadPreliminaryValues(){
		$role = Authenticate::checkRole();
		if(Session::get('user_id') < 0){
			redirect('login');
		}
		$this->shoppingCart = new ShoppingCart();
		$this->shoppingCart->userId = Session::get('user_id');
		$this->shoppingCart->checkHasCart();
		$this->shoppingCart->getActiveCart();
		$products = $this->shoppingCart->doesCartHaveItems();
		$data['products'] = $products;
		$data['cart_total'] = $this->shoppingCart->cartTotal;
		$data['new_item']['price'] = '';
		$data['new_item']['name'] = '';
		$data['new_item']['productId'] = '';
		return $data;
	}

}