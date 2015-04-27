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

		if($state == 0){
			return view('sign-up');
		}
		else{
			$user->addUser();
			return view('login');
		}
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