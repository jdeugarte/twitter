@extends('app')


@section('content')
<div id="fondo2">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-success">
					<div class="panel-heading text-center">My Tweets</div>
						<div class="panel-body">
							@if(Auth::user()->username == $user->username)

								<form role="form" method="POST" action="{{ url('/tweet/store') }}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									
									<div class="form-group">
										<textarea name='tweet' id="tweet" maxlength="140" class="form-control" rows="3"></textarea>
									</div>
									<div class="car"></div>
									<input type="submit" value="Post" name="post" class="btn btn-success">
								</form>
								<hr class="divider">

								
							@endif

							@if(Auth::user()->username != $user->username)
								@if(Auth::user()->is_following($user->id))
									 <a href={{"/unfollow/".$user->id}}>Unfollow</a>
								@else
									<a href={{"/follow/".$user->id}}>Follow</a>
								@endif
							@endif

								@foreach ($user->tweets as $tweet)
									<h3>You tweeted:</h3>
									<p>{{$tweet->tweet}}</p>
									<p>{{$tweet->created_at}}</p>
									<hr class="divider">
								@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
@endsection

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.car').html('Remaining characters: 140');
		$('#tweet').keypress(function(){
			c= 140 - $('#tweet').val().length;
			$('.car').html("Remaining characters: "+c);
		});
	});
</script>

<script type="text/javascript">
	
</script>