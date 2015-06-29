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

@foreach ($user->tweets->reverse() as $tweet)
	<p>{{$tweet->tweet}}</p>
	<p>{{$tweet->likes()}} people like this and {{$tweet->repost_number()}} reposted this</p>
	@if($tweet->is_liked_by(Auth::user())==false)
		<form class="form-horizontal" role="form" method="POST" action="{{ url('/like') }}">
	 		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	 		<input type="hidden" name="user_id" value={{ Auth::user()->id }}>
			<input type="hidden" name="tweet_id" value={{ $tweet->id }}>
			<input type="submit" value="like">
		</form>

	@else
		<p><a href="/unlike/{{Auth::user()->id}}/{{$tweet->id}}">Unlike</a></p>
	@endif
	@if(Auth::user()->username != $user->username)
		<p><a href="/repost/{{$tweet->id}}/{{Auth::user()->id}}">Repost</a></p>
	@endif



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