@extends('app')


@section('content')
<h1>{{$user->username}}</h1>

@if(Auth::user()->username == $user->username)
	<form class="form-horizontal" role="form" method="POST" action="{{ url('/tweet/store') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="input" name="tweet">
		<input type="submit" value="post" name="post">
	</form>

@else
	@if(!Auth::user()->following_user($user))
		<a class='.ajax_buttonF' href="/user/follow/{{$user->id}}">FOLLOW</a>
	@else
		<a class='.ajax_buttonU' href="/user/unfollow/{{$user->id}}">UNFOLLOW</a>
	@endif
@endif

@foreach ($user->tweets as $tweet)
	<p>{{$tweet->tweet}}</p>
@endforeach

	
@stop
