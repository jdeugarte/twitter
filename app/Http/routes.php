<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('/repost/{tweet_id}/{user_id}', 'TweetsController@repost', array(
		'uses'=>'TweetsController@repost'
	));


Route::post('/like', 'LikesController@store');
Route::get('/unlike/{user_id}/{tweet_id}', 'LikesController@destroy', array(
		'uses'=>'LikesController@destroy'
	));



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/{username}', array(
    'uses' => 'UsersController@show',
));


Route::post('/tweet/store', 'TweetsController@store');

Route::filter('csrf', function()
{
  if (Request::getMethod() !== 'GET' && Session::token() != Input::get('_token'))
  {
      throw new Illuminate\Session\TokenMismatchException;
  }
});