<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Image extends Model {
	
	protected $table = 'images';

    protected $fillable = [
        'title',
        'description',
        'image'
    ];

    public function user()
	{
		return $this->belongsTo('App\User');
	}
}
