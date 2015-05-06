<?php namespace App\Models;

use  Illuminate\Database\DatabaseManager;
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

	public function deleteCategory(){
		$delRow = DB::delete('delete from categories where name = ?', [$this->cat_name]);
		return true;
	}

	public static function showCategories(){
		$results = DB::select('select * from categories');
		return $results;
	}

	public function checkDuplicate(){
		$results = DB::select('select name from categories where name = ?', [$this->cat_name]);
		if($results == false){
			return false;
		}
		return true;
	}

}