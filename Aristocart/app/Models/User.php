<?php namespace App\Models;

use  Illuminate\Database\DatabaseManager;
use DB;

class User{
	public $name;
	public $age;
	public $state_id;

	public function addUser(){
		$results = DB::insert('insert into users (name, age, state_id) values(?,?,?)', [$this->name, $this->age, $this->state_id]);
		echo $results;
	}

	public function doesUserExist(){
		$results = DB::select('select from users where name = ?', [$name]);
	}

}