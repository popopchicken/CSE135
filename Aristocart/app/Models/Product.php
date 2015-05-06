<?php namespace App\Models;

use Illuminate\Database\DatabaseManager;
use DB;
use Session;

class Product {
	public $itemName;
	public $skuNum;
	public $price;
	public $categoryId;
	public $description = ' ';
	public $productId;

	public function addProduct(){

		$errors = self::validateUserInput(false);

		if(empty($errors)){
			DB::insert('INSERT INTO products (name, sku, price, description) VALUEs(?, ?, ?, ?)', [$this->itemName, $this->skuNum, $this->price, $this->description]);
			$product = self::getProductBySku(false);
			$this->productId = $product->id;
			DB::insert('INSERT INTO category_products (category_id, product_id) VALUES(?,?)', [$this->categoryId, $this->productId]);
			return $errors;
		} else{
			return $errors;
		}
	}

	public function updateProduct(){
		$errors = self::validateUserInput(true);
		if(empty($errors)){
			$results = DB::update('UPDATE products AS p 
				INNER JOIN category_products AS c ON p.id = c.product_id 
				SET p.name = ?, 
				p.sku = ?, 
				p.price = ?, 
				c.category_id = ? 
				WHERE p.id = ?', 
				[
					$this->itemName, 
					$this->skuNum, 
					$this->price, 
					$this->categoryId, 
					$this->productId
				]
			);
		}
		return $errors;
	}

	public function getProductById($id){
		$product = DB::select('SELECT * FROM products WHERE id = ?', [$id]);
		return $product;
	}

	public function getProductBySku($update){
		if($update){
			$results = DB::select('SELECT * FROM products WHERE sku = ? AND id != ?', [$this->skuNum, $this->productId]);
		} else{
			$results = DB::select('SELECT * FROM products WHERE sku = ?', [$this->skuNum]);
		}
		if(!$results){
			return false;
		} else{
			return $results[0];
		}
	}

	public static function getProductsByCategoryId($category){
		if($category > -1){
			$products = DB::select('SELECT * 
				FROM products AS p 
				LEFT JOIN category_products AS c 
				ON p.id = c.product_id 
				WHERE c.category_id = ?', 
				[$category]
			);
		} else{
			$products = DB::select('SELECT *
				FROM products AS p
				LEFT JOIN category_products AS c
				ON p.id = c.product_id'
			);
		}
		return $products;

	}

	public function deleteProduct(){
		$errors = array();
		DB::delete('DELETE p.*, c.* FROM products AS p 
			INNER JOIN category_products AS c 
			ON p.id = c.product_id
			WHERE p.id = ?',
			[$this->productId]
		);
		return $errors;
	}

	private function validateUserInput($update){
		$errors = array();
		if($this->itemName == ''){
			$errors['name'] = "Please enter a valid product name";
		}
		if($this->skuNum > 0){
			$results = self::getProductBySku($update);
			if($results){
				$errors['sku'] = "This SKU number is being used by another product";
			}
		} else {
			$errors['sku'] = "Please enter a valid SKU number";
		}

		if($this->price <= 0){
			$errors['price'] = "Please enter a valid price";
		}

		if($this->categoryId < 1){
			$errors['category'] = "Please select a valid category";
		}
		return $errors;
	}

	public function searchForProduct(){
		if($this->categoryId < 0){
			$products = DB::select('SELECT * FROM products AS p 
				INNER JOIN category_products AS c ON p.id = c.product_id
				WHERE p.name LIKE ?', 
				['%'.$this->itemName.'%']
			);
		} else{
			$products = DB::select('SELECT * FROM products AS p 
				INNER JOIN category_products AS c 
				ON p.id = c.product_id 
				WHERE p.name LIKE ? 
				AND c.category_id = ?', 
				['%'.$this->itemName.'%', $this->categoryId]
			);
		}
		return $products;

	}
}