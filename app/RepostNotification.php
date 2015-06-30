<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RepostNotification extends Model {
	protected $fillable = ['tweet_id','seen','user_id'];

	//

}
