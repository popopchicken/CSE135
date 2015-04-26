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
		$user->name = 'Tyler';
		$user->age = 22;
		$user->state_id = 1;
		$user->addUser();
		//TODO: Logic for logging in needs to be added here.
		return view('store/categories');
	}

}