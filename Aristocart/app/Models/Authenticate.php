<?php namespace App\Models;

use  Illuminate\Database\DatabaseManager;
use DB;
use Session;

class Authenticate{

	//Logs the user in and sets their 'last logged in' field to the current date
	public static function login($name){
		if(Session::get('user_id')>0){
			return true;
		} else{
			$results = DB::select('SELECT users.id, roles.role_type from users INNER JOIN roles ON users.id = roles.user_id WHERE users.name = ?', [$name]);
			if($results){
				$time = date("Y-m-d H:i:s");
				DB::update('UPDATE users SET last_authenticated = ?', [$time]);
				var_dump($results[0]);
				Session::put('user_id', $results[0]->id);
				Session::put('user_role', $results[0]->role_type);
				return true;
			}

		}
	}

	public static function logout(){
		//TODO: May need to update the last_authenticated for a user to 0 to prevent Session security issues
		Session::flush();
		Session::regenerate();
		return true;
	}

	//Used when loading a controller to confirm permissions of the user
	public static function checkRole(){
		if(Session::get('user_id') > 0){
			if(!self::checkExpiredLogin()){
				if(Session::get('user_role') == 'owner'){
				return 'owner';
				}
				else if(Session::get('user_role') == 'customer'){
					return 'customer';
				}
			} else{
				return false;
			}
			
		} else{
			return false;
		}		
	}

	//Checks to see if the user has been logged in for longer than the given time, and logs them out if they have
	public static function checkExpiredLogin(){
		$results = DB::select('SELECT last_authenticated FROM users WHERE id =?', [Session::get('user_id')]);
		$last_login = $results[0]->last_authenticated;
		$last_login = strtotime($last_login);
		$difference = strtotime(date("Y-m-d H:i:s")) - $last_login;

		//Automatically logs the user out after an hour of inactivity
		if($difference>3600){			
			self::logout();
			return true;
		}
		return false;
	}

}