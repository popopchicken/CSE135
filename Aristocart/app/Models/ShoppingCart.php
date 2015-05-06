<?php namespace App\Models;

use Illuminate\Database\DatabaseManager;
use DB;
use Session;

class ShoppingCart {
	public $userId;
	public $cart;
	public $cartId;
	public $products;
	public $cartTotal = 0;

	public function getActiveCart(){
		$this->cart = DB::select('SELECT * FROM user_carts WHERE active = ? AND user_id = ?', ['true', $this->userId]);
		$this->cartId = $this->cart[0]->cart_id;
	}

	public function checkHasCart(){
		$results = DB::select('SELECT * FROM user_carts WHERE user_id = ?', [$this->userId]);
		if(!$results){
			self::createCart();
		}
	}

	public function createCart(){
		$this->cartId = DB::table('carts')->insertGetId(array('total_price' => 0));		
		DB::insert('INSERT INTO user_carts (user_id, cart_id) VALUES(?,?)', [$this->userId, $this->cartId]);
	}

	public function addProductToCart(){
		DB::insert('INSERT INTO carts_products (cart_id, product_id, quantity) VALUES(?,?,?)', [$this->cartId, $productId, $quantity]);
		$results = DB::select('SELECT total_price FROM carts WHERE id = ?', [$this->cartId]);
		$total = $quantity * $item_price;
		DB::update('UPDATE carts SET total_price = ?', [$total]);
	}

	public function doesCartHaveItems(){
		$results = DB::select('SELECT * FROM carts_products WHERE cart_id = ?', [$this->cartId]);
		if(!$results){
			$products = array();
			return $products;
		}else{
			$this->products = $results;
			self::getCartTotal();
			return $results;
		}
	}

	public function getCartTotal(){
		foreach($products as $product){
			var_dump($product);
		}
	}
}