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
Route::post('/update_profile', 'UsersController@update');



Route::get('/change_profile', 'UsersController@edit');


Route::get('/tweet/{id}', 'TweetsController@show', array (
	'uses'=>'TweetsController@show'
	));

Route::post('/reply_tweet/store', 'TweetsController@reply_store');


Route::get('/reply/{tweet_id}', 'TweetsController@reply', array (
	'uses'=>'TweetsController@reply'
	));
Route::get('/notifications', 'NotificationsController@index');

Route::get('/', 'HomeController@index');


Route::get('/repost/{tweet_id}/{user_id}', 'TweetsController@repost', array(
		'uses'=>'TweetsController@repost'
	));


Route::post('/like', 'LikesController@store');
Route::get('/unlike/{user_id}/{tweet_id}', 'LikesController@destroy', array(
		'uses'=>'LikesController@destroy'
	));

Route::get('/follow/{user_id}', 'UsersController@follow');

Route::get('/unfollow/{user_id}', 'UsersController@unfollow');

Route::get('/following', 'HomeController@following');

Route::get('/followers', 'HomeController@followers');

Route::get('/add_picture', 'ImageController@upload' );

Route::post('/add_picture', 'ImageController@store' );

Route::get('/search_results','HomeController@search_results');

Route::post('/search', 'HomeController@search');

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