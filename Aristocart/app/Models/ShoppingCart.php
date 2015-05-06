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
		$results = DB::select('SELECT * FROM user_carts WHERE user_id = ? AND active = ?', [$this->userId, 'true']);
		if(!$results){
			self::createCart();
		}
	}

	public function createCart(){
		$this->cartId = DB::table('carts')->insertGetId(array('total_price' => 0));		
		DB::insert('INSERT INTO user_carts (user_id, cart_id) VALUES(?,?)', [$this->userId, $this->cartId]);
	}

	public function addProductToCart($productId, $quantity, $price){
		if($quantity > 0){
			DB::insert('INSERT INTO carts_products (cart_id, product_id, quantity) VALUES(?,?,?)', [$this->cartId, $productId, $quantity]);
			$results = DB::select('SELECT total_price FROM carts WHERE id = ?', [$this->cartId]);
			$this->cartTotal = $results[0]->total_price;
			if($this->cartTotal == 0){
				$this->cartTotal = $quantity * $price;
			} else{
				$this->cartTotal = self::getCartTotal();
			}
			DB::update('UPDATE carts SET total_price = ? WHERE id = ?', [$this->cartTotal, $this->cartId]);
		}
		
	}

	public function doesCartHaveItems(){
		$results = DB::select('SELECT * FROM carts_products AS c LEFT JOIN products AS p on c.product_id = p.id WHERE cart_id = ?', [$this->cartId]);
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
		$results = DB::select('SELECT total_price FROM carts WHERE id = ?',[$this->cartId]);
		$sum = DB::select('SELECT SUM(c.quantity * p.price) AS sum FROM carts_products AS c RIGHT JOIN products AS p ON c.product_id = p.id WHERE c.cart_id = ?', [$this->cartId]);
		$this->cartTotal = $sum[0]->sum;
	}

	public function buyCart(){
		DB::update('UPDATE user_carts SET active = ? WHERE user_id = ?', ['false', $this->userId]);
		self::createCart();
	}
}