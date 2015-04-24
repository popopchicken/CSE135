<?php namespace App\Models;

use  Illuminate\Database\DatabaseManager;


class User{
	public $name;
	public $age;
	public $state_code;

	public function addUser(){
		$results = DB::insert('insert into users (name, age, state) values(?,?)', [$name, $age, $state_code]);
	}

	public function doesUserExist(){
		$results = DB::select('select from users where name = ?', [$name]);
	}

}