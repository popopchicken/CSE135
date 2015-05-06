<?php namespace App\Models;

use Illuminate\Database\DatabaseManager;
use DB;
use Session;

class Category {
	public $cat_name;
	public $cat_description;
	public $userID;
	public $cat_id;

	public function addCategory(){
		$duplicate = self::checkDuplicate(false);
		$validate = self::validateUserInput();
		if($duplicate){
			$message = "Category already exists";
			return $message;
		}
		if(!empty($validate)){
			if($validate['name'] == false && $validate['description'] == false){
				$message = "Must input a Category's name and description";
				return $message;
			}
			else if($validate['name'] == false){
				$message = "Must input a Category's name";
				return $message;
			}
			else if($validate['description'] == false){
				$message = "Must input a Category's description";
				return $message;
			}
		}
		$this->userID = Session::get('user_id');
		$newCat = DB::insert('insert into categories (name, description, created_by_user_id) values(?,?,?)', [$this->cat_name, $this->cat_description, $this->userID]);	
		$this->cat_id = self::returnCatID();
		$message = "Successfully added Category";
		return $message;
	}

	private function returnCatID(){
		$id = DB::select('SELECT id FROM categories WHERE name = ?', [$this->cat_name]);
		return $id;
	}

	public static function getCategories(){
		$categories = array();
		$results = DB::select('SELECT * FROM categories');
		foreach($results as $result){
			$categories[$result->id] = $result->name;
		}
		return $categories;
	}

	public static function showCategories(){
		$results = DB::select('select * from categories');
		return $results;
	}

	public function deleteCategory(){
		//$errors = array();
		$delRow = DB::delete('delete from categories where name = ?', [$this->cat_name]);
		$message = "Successfully deleted the Category $this->cat_name";
		return $message;
	}

	public function updateCategory(){
		$duplicate = self::checkDuplicate(true);
		$validate = self::validateUserInput();

		if($duplicate){
			$message = "Category name already exists";
			return $message;
		}
		if(!empty($validate)){
			if($validate['name'] == false && $validate['description'] == false){
				$message = "Cannot have a blank Category name and description";
				return $message;
			}
			else if($validate['name'] == false){
				$message = "Cannot have a blank Category name";
				return $message;
			}
			else if($validate['description'] == false){
				$message = "Cannot have a blank Category description";
				return $message;
			}
		}
		$updateCat = DB::update('UPDATE categories SET name = ?, description = ? WHERE id = ?', [$this->cat_name, $this->cat_description, $this->cat_id]);
		$message = "Successfully updated Category";
		return $message;
	}

	public static function hasProducts(){
		$results = DB::select('SELECT * from category_products WHERE category_id = ?', [$this->cat_id]);
		if($results == false){
			return false;
		}
		return true;
	}

	public static function allCatsWithProducts(){
		$results = DB::select('SELECT * from category_products');
		return $results;
	}

	private function validateUserInput(){
		$errors = array();
		if($this->cat_name == ''){
			$errors['name'] = false;
		}
		else {
			$errors['name'] = true;
		}
		if($this->cat_description == ''){
			$errors['description'] = false;
		}
		else {
			$errors['description'] = true;
		}
		return $errors;
	}

	private function checkDuplicate($update){
		if($update){
			$results = DB::select('SELECT * from categories where name = ? and id != ?', [$this->cat_name, $this->cat_id]);
		}
		else {
			$results = DB::select('select name from categories where name = ?', [$this->cat_name]);
		}
		if($results == false){
			return false;
		}
		return true;
	}
}