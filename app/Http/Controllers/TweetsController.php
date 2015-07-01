<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Tweet;
use App\User;
use Auth;
use Input;
use App\Http\Requests\TweetRequest;
use App\RepostNotification;


class TweetsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	
	public function reply($tweet_id)
	{
		$tweet=Tweet::find($tweet_id);
		return view('reply', compact('tweet'));

	}

	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tweets.create');
	}

	public function like()
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(TweetRequest $request)
	{
		$input = $request->all();
		$tweet = new Tweet($input);
		$tweet->tweet_id = 0;
		$tweet->original_tweet_id=0;
		Auth::user()->tweets()->save($tweet);
		return redirect()->back();
	}

	public function reply_store(TweetRequest $request)
	{
		$input = $request->all();
		$tweet = new Tweet($input);
		$tweet->tweet_id = 0;
		$tweet->original_tweet_id=Input::get('original_tweet_id');
		$tweet->country_id=Input::get('country_id');
		Auth::user()->tweets()->save($tweet);

		$notification = new RepostNotification;
		$notification->user_id=Auth::user()->id;
		$notification->my_user_id=Tweet::find($tweet->original_tweet_id)->user->id;
		$notification->tweet_id=$tweet->original_tweet_id;
		$notification->type="Reply";
		$notification->reply_id=$tweet->id;
		$notification->save();

		return redirect('/');
	}

	public function repost($tweet_id,$user_id)
	{
		$post = Tweet::find($tweet_id);
		$repost= new Tweet();
		$repost->tweet_id=$tweet_id;
		$repost->tweet=$post->tweet;
		$repost->user_id=$user_id;
		$repost->original_tweet_id = 0;
		$repost->save();

		$notification = new RepostNotification;
		$notification->user_id=Auth::user()->id;
		$notification->my_user_id=Tweet::find($tweet_id)->user->id;
		$notification->tweet_id=$tweet_id;
		$notification->reply_id=0;
		$notification->type="Repost";
		$notification->save();
		return redirect('/'.Auth::user()->username);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$tweet= Tweet::find($id);
		$user= User::find($tweet->user_id);
		return view('tweets.show', compact('tweet','user'));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
