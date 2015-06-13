<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use App\User;

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
		$tweets = Auth::user()->tweets;
		foreach (Auth::user()->following() as $cuate)
		{
			foreach ($cuate->tweets as $tweet)
			{
				array_push($tweets, $tweet);
			}
		}

		$data = array(
		    'tweets'  => $tweets
		);
	
		return view('home')->with($data);
	}

}
