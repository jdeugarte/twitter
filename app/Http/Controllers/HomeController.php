<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Input;
use App\User;
use App\Tweet;

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
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tweets = Tweet::all();
		$words = [];
		$aux = [];
		foreach ($tweets as $tweet) {
			$aux = (array) $tweet->tweet;
			$aux = $aux[0];
			$aux = str_replace(',','',$aux);
			$aux = explode(' ',$aux);
			$words = array_merge($aux,$words);
		}
		$words = array_count_values($words);
		arsort($words);
		$words = array_keys($words);
		$aux = [];
		for ($i=0; $i<sizeof($words); $i++){
			if (strlen($words[$i])>3) {
				$aux[] = $words[$i];
			}
		}
		$words = $aux;

		$user = Auth::user();
		return view('home',compact('user','words'));
	}

	public function following(){
		$user = Auth::user();
		return view('following',compact('user'));
	}

	public function followers(){
		$user = Auth::user();
		return view('followers',compact('user'));
	}

	public function search(){
		$search = Input::get('search');
		$users = null;
		$tweets = null;
		if ($search!="") {
			$users = User::where('username','like','%'.$search.'%')->get();	
			$tweets = Tweet::where('tweet','like','%'.$search.'%')->get();
		}
		return view('search_results',compact('users','tweets'));
	}

	public function search_results(){
		return view('home');
	}

}
