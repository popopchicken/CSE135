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

	public function addProduct(){
		$errors = array();
		if($this->itemName == ''){
			$errors['name'] = "Please enter a valid product name";
		}
		if($this->skuNum > 0){
			$results = self::getProductBySku();
			if($results){
				$errors['sku'] = "This SKU number is being used by another product";
			}
		} else{
			$errors['sku'] = "Please enter a valid SKU number";
		}

		if($this->price <= 0){
			$errors['price'] = "Please enter a valid price";
		}

		if($this->categoryId < 0){
			$errors['category'] = "Please select a valid category";
		}

		if(empty($errors)){
			DB::insert('INSERT INTO products (name, sku, price, description) VALUEs(?, ?, ?, ?)', [$this->itemName, $this->skuNum, $this->price, $this->description]);
			$product = self::getProductBySku();
			DB::insert('INSERT INTO category_products (category_id, product_id) VALUES(?,?)', [$product->id, $this->categoryId]);
			return $errors;
		} else{
			return $errors;
		}
	}

	public function getProductById(){

	}

	public function getProductBySku(){
		$results = DB::select('SELECT * FROM products WHERE sku = ?', [$this->skuNum]);
		if(!$results){
			return false;
		} else{
			return $results[0];
		}
	}

	public function getProductsByCategoryId(){

	}
}