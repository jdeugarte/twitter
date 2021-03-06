<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tweet;

use Illuminate\Http\Request;
use App\Like;
use Auth;
use App\Http\Requests\LikeRequest;
use App\RepostNotification;

class LikesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
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
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(LikeRequest $request)
	{
		$input = $request->all();
		$like = new Like($input);
		$like->save();

		$notification = new RepostNotification;
		$notification->user_id=Auth::user()->id;
		$notification->my_user_id=Tweet::find($like->tweet_id)->user->id;
		$notification->tweet_id=$like->tweet_id;
		$notification->type="Like";
		$notification->reply_id=0;
		$notification->save();
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
	public function destroy($user_id,$tweet_id)
	{
		$like = Like::where('user_id',$user_id)->where('tweet_id',$tweet_id);
		$like->delete();
		return redirect()->back();
	}

}
