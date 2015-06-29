<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Tweet extends Model {
	protected $fillable = ['tweet'];
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	//

}
