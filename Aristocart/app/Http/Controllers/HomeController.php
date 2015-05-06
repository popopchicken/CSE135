<?php namespace App\Http\Controllers;
use App\Models\Authenticate;
use Session;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
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
	 * Show the application dashboard depending whether guest or owner. 
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['name'] = Session::get('name'); 
		$data['role'] = Authenticate::checkRole();
		return view('/home')->with('data', $data);
	}

}
