<?php namespace App\Http\Controllers;

use App\HTTP\Requests\LoginFormRequest;
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
		//TODO: Logic for logging in needs to be added here.
		return view('store/categories');
	}

}