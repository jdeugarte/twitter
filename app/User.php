<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Follow;
use App\Image;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name','username' ,'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function tweets()
	{
		return $this->hasMany('App\Tweet');
	}

	public function image()
	{
		return $this->hasOne('App\Image');
	}

	/*
	public function following_users_tweets(){
		$users_ids = $this->following();
		foreach ($user_ids_array as $id) {
			$user = User::find($id);
		}
	}
	*/

	//Function to follow a user
	public function follow($user_id){
		$follow = new Follow;
		$follow->follower_id = $this->id;
		$follow->followed_user_id = $user_id;
		$follow->save();
	}

	//Function to unfollow a user
	public function unfollow($user_id){
		$follow = Follow::where('follower_id',$this->id);
		$follow = $follow->where('followed_user_id',$user_id);
		$follow->delete();
	}

	//Function to know if a user is following a user
	public function is_following($user_id){
		$res = false;
		if (in_array($user_id, $this->following())!=false) {
			$res = true;
		}
		return $res;
	}

	//Function that returns an array of all the ids of the users being followed
	public function following(){
		$follows = Follow::all();
		$user_ids_array = [];
		foreach ($follows as $f) {
			if ($f->follower_id==$this->id) {
				$user_ids_array[] = $f->followed_user_id;		
			}
		}
		return $user_ids_array;
	}

	//Function that returns an array of all the users that are following
	public function followed_by(){
		$follows = Follow::all();
		$user_ids_array = [];;
		foreach ($follows as $f) {
			if ($f->followed_user_id==$this->id) {
				$user_ids_array[] = $f->follower_id;
			}
		}
		return $user_ids_array;
	}

}
