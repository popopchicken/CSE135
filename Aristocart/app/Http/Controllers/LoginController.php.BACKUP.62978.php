<?php namespace App\Http\Controllers;

use App\HTTP\Requests\LoginFormRequest;
use App\Models\User;
use Response;
use View;

class LoginController extends Controller {

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
		return view('login');
	}

	public function signUp()
	{
		//TODO: Logic for signing up needs to be added here.
		return view('sign-up');
	}

	public function login()
	{
		$user = new User();
<<<<<<< HEAD
		$user->name = 'Tyler';
		$user->age = 22;
		$user->state_id = 1;
		$user->addUser();
=======
		//TODO: Add user data here
		//Ex: $user->name = "Tyler";
		//$user->addUser();
>>>>>>> 6ca78d2be3871c68ed16cf1216271a24014a8caa
		//TODO: Logic for logging in needs to be added here.
		return view('store/categories');
	}

}