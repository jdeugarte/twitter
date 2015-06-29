@extends('app')


@section('content')
<h1>{{$user->username}}</h1>

@if(Auth::user()->username == $user->username)
	<div class="car"></div>
	<form class="form-horizontal" role="form" method="POST" action="{{ url('/tweet/store') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<textarea name='tweet' id="tweet" maxlength="140"></textarea>
		<input type="submit" value="post" name="post">
	</form>
@endif

@if(Auth::user()->username != $user->username)
	@if(Auth::user()->is_following($user->id))
		 <a href={{"/unfollow/".$user->id}}>Unfollow</a>
	@else
		<a href={{"/follow/".$user->id}}>Follow</a>
	@endif
@endif

@foreach ($user->tweets as $tweet)
	<p>{{$tweet->tweet}}</p>
@endforeach

	
@stop

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.car').html('140');
		$('#tweet').keypress(function(){
			c= 140 - $('#tweet').val().length;
			$('.car').html(c);
		});
	});
</script>

<script type="text/javascript">
	
</script>