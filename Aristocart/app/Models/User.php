<?php namespace App\Models;

use  Illuminate\Database\DatabaseManager;
use DB;

class User{
	public $name;
	public $age;
	public $state_id;
	public $role;
	public $id;

	public function addUser(){
		//TODO: Use a transaction here to make it so we do not need two different statements.
		//TODO: Can also get the last inserted id somehow... Not sure how
		$results = DB::insert('insert into users (name, age, state_id) values(?,?,?)', [$this->name, $this->age, $this->state_id]);
		if($results){
			$tempId = self::getUserIdByName();
			if($tempId > 0){
				$this->id = $tempId;
				$results = DB::insert('insert into roles (user_id, role_type) values(?,?)', [$this->id, $this->role]);
			}
		}
		return true;
	}

	public function doesUserExist(){
		$results = DB::select(' from users where name = ?', [$this->name]);
	}

	public function getUserIdByName(){
		//TODO: Should limit this to just the id
		$results = DB::select('SELECT * FROM users WHERE name = ?', [$this->name]);
		if(!empty($results)){
			return $results[0]->id;
		}
		else{
			return false;
		}
	}

}