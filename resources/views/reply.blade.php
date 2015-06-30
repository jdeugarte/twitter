@extends('app')
@section('content')
<div id="fondo2">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-success">
					<div class="panel-heading text-center">Replying to <a href="/{{$tweet->user->username}}">{{$tweet->user->username}}</a>'s <a href="/tweet/{{$tweet->id}}">post</a></div>
						<div class="panel-body">
							
							<form role="form" method="POST" action="{{ url('/reply_tweet/store') }}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="original_tweet_id" value="{{ $tweet->id }}">
									
									<div class="form-group">
										<textarea name='tweet' id="tweet" maxlength="140" class="form-control" rows="3"></textarea>
									</div>
									<div class="car"></div>
									<input type="submit" value="Post" name="post" class="btn btn-success">
								</form>
								<hr class="divider">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
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