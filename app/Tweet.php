<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Like;
use App\RepostNotification;
use App\Country;
class Tweet extends Model {
	protected $fillable = ['tweet','country_id'];
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function country()
	{
		return Country::find($this->country_id);
	}

	public function likes()
	{
		return Like::where('tweet_id',$this->id)->count();
	}

	public function is_liked_by($user)
	{
		return Like::where('tweet_id',$this->id)->where('user_id',$user->id)->first();
	}

	public function repost_number()
	{
		return Tweet::where('tweet_id', $this->id)->count();
	}
}
