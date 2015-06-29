<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Follow extends Model {
	protected $fillable = ['follower_id','followed_user_id'];

	public function user_following(){
		$id = $this->follower_id;
		return User::find($id);
	}

	public function followed_user(){
		$id = $this->followed_user_id;
		return User::find($id);
	}

}
