<?php namespace App\Http\Controllers;
use Request;
use App\Models\User;
use App\Models\Authenticate;
use Illuminate\Http\RedirectResponse;
use Response;
use View;
use URL;

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
		if(!Authenticate::checkRole()){
			return view('login');
		}
		else{
			return redirect('home');
		}
	}
	
	public function login()
	{
<<<<<<< HEAD
		Authenticate::login(Request::input('user_name'));
		return redirect('home');
=======
		$errors = Authenticate::login(Request::input('user_name'));
		if(!empty($errors)){
			return redirect('login')->with('errors', $errors);
		}
		return redirect('store/categories');
>>>>>>> a8d55e08d1cde88e3db534ebc223ff1e4c695755
	}

	public function logout(){
		Authenticate::logout();
		return redirect('login');
	}
}