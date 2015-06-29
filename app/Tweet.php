<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Like;
class Tweet extends Model {
	protected $fillable = ['tweet'];
	public function user()
	{
		return User::find($this->user_id);
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




	// App\Like::where('tweet_id',1)->where('user_id',1);

}
