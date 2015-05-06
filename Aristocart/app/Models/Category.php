<?php namespace App\Models;

use Illuminate\Database\DatabaseManager;
use DB;
use Session;

class Category {
	public $cat_name;
	public $cat_description;
	public $userID;

	public function addCategory(){
		$this->userID = Session::get('user_id');
		$newCat = DB::insert('insert into categories (name, description, created_by_user_id) values(?,?,?)', [$this->cat_name, $this->cat_description, $this->userID]);	
		return true;
	}

	public static function getCategories(){
		$categories = array();
		$results = DB::select('SELECT * FROM categories');
		foreach($results as $result){
			$categories[$result->id] = $result->name;
		}
		return $categories;
	}
}