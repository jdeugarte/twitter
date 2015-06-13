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

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/{username}', array(
    'uses' => 'UsersController@show',
));


Route::post('/tweet/store', 'TweetsController@store');

Route::get('/user/follow/{idToFollow}', 'UsersController@follow');
Route::get('/user/unfollow/{idToUnfollow}', 'UsersController@unfollow');

Route::filter('csrf', function()
{
  if (Request::getMethod() !== 'GET' && Session::token() != Input::get('_token'))
  {
      throw new Illuminate\Session\TokenMismatchException;
  }
});