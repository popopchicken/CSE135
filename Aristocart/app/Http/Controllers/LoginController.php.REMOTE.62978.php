<?php namespace App\Http\Controllers;

use Request;
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
		$user_name = Request::input('user_name');

		return view('sign-up');
	}

	public function login()
	{
		$user = new User();
		//TODO: Add user data here
		//Ex: $user->name = "Tyler";
		//$user->addUser();
		//TODO: Logic for logging in needs to be added here.
		return view('store/categories');
	}

}