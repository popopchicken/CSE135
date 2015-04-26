<?php namespace App\Models;

use  Illuminate\Database\DatabaseManager;
use DB;

class User{
	public $name = '';
	public $age = 0;
	public $state_id = 0;

	public function addUser(){
		$results = DB::insert('insert into users (name, age, state_id) values(?,?,?)', [$name, $age, $state_id]);
	}

	public function doesUserExist(){
		$results = DB::select('select from users where name = ?', [$name]);
	}

}