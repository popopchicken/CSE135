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

class BuyShoppingCartController extends Controller {
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
		return view('store/buy-shopping-cart')->with('data', $data);
	}

	public function buyCart(){
		$data = self::loadPreliminaryValues();
		if(Request::input('credit_card') > 0){
			$this->shoppingCart->buyCart();
			return view('store/confirmation-page')->with('data',$data);
		}
		else{
			$errors = 'Please enter a valid credit card';
			$data['errors'] = $errors;
			return view('store/buy-shopping-cart')->with('data', $data);
		}
	}

	public function confirmPage(){
		if(!Session::get('user_id')){
			return redirect('access-denied');
		}
		$data = self::loadPreliminaryValues();
		return redirect('store/confirmation-page')->with('data', $data);
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
		return $data;
	}

}