<?php namespace App\Http\Controllers;

use View;
use Request;
use App\Models\User;

class SignUpController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Signup Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "sign up" for the application and
	| is configured to only allow guests.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the sign up screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$states = array(
			"1" => "AL","2" => "AK","3" => "AZ","4" => "AR",
			"5" => "CA","6" => "CO","7" => "CT","8" => "DE",
			"9" => "FL","10" => "GA","11" => "HI","12" => "ID",
			"13" => "IL","14" => "IN","15" => "IA","16" => "KS",
			"17" => "KY","18" => "LA","19" => "ME","20" => "MD",
			"21" => "MA","22" => "MI","23" => "MN","24" => "MS",
			"25" => "MO","26" => "MT","27" => "NE","28" => "NV",
			"29" => "NH","30" => "NJ","31" => "NM","32" => "NY",
			"33" => "NC","34" => "ND","35" => "OH","36" => "OK",
			"37" => "OR","38" => "PA","39" => "RI","40" => "SC",
			"41" => "SD","42" => "TN","43" => "TX","44" => "UT",
			"45" => "VT","46" => "VA","47" => "WA","48" => "WV",
			"49" => "WI","50" => "WY",
			);
		return View::make('sign-up')->with('states', $states);
	}

	public function signUp()
	{
		$errors = array();
		$data = array();
		$user_name = Request::input('user_name');
		$role = Request::input('role');
		$age = Request::input('age');
		$state = Request::input('state');

		$user = new User();
		$user->name = $user_name;
		$user->role = $role;
		$user->age = $age;
		$user->state_id = $state;
		//var_dump($user);

		$errors = $user->validateUserInput();
		
		if(!empty($errors)){
			$data['result'] = 'Failed';
			$data['errors'] = $errors;
			return View::make('sign-up-results')->with('data', $data);
		}
		if(!$user->addUser()){
			$errors['name'] = 'The name you have provided has already been taken';
		}
		if(!empty($errors)){
			$data['result'] = 'Failed';
			$data['errors'] = $errors;
			return View::make('sign-up-results')->with('data', $data);
		}

		$data['result'] = 'Successful';
		return view('sign-up-results')->with('data', $data);
	}

	

}