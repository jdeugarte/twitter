@extends('app')
@section('content')
<div id="fondo2">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-success">
					<div class="panel-heading text-center">My Profile</div>
						<div class="panel-body">

						@if($user->image!=null)
							<img class="img-responsive" src="{!! '/images/'.$user->image->filePath !!}" >
						@else
							<img class="img-responsive" src="/profile.png" >
						@endif
						<h4 class="text-center">Posts: {{$user->tweets->count()}} &nbsp&nbsp&nbsp Followers: {{sizeof($user->followed_by())}} &nbsp&nbsp&nbsp Following: {{sizeof($user->following())}}</h4>
						
							@if(Auth::user()->username == $user->username)
								<form role="form" method="POST" action="{{ url('/tweet/store') }}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									
									<div class="form-group">
										<textarea name='tweet' id="tweet" maxlength="140" class="form-control" rows="3"></textarea>
									</div>
									<div class="car"></div>
									<div class="col-md-6">
										<select class="form-control" name="country_id">
										@foreach (App\Country::all() as $country)
											  <option 
											  @if($country->id==$user->country_id)
											  	selected
											  @endif
											  value="{{$country->id}}">{{$country->name}}</option>
										@endforeach
										</select>
									</div>
									<input type="submit" value="Post" name="post" class="btn btn-success">
								</form>
								<hr class="divider">
							@endif

							<hr class="divider">
							<h3 class="text-center">My Tweets</h3>
							<hr class="divider">

							@if(Auth::user()->username != $user->username)
								@if(Auth::user()->is_following($user->id))
									 <a href={{"/unfollow/".$user->id}} class="btn btn-danger">Unfollow</a>
								@else
									<a href={{"/follow/".$user->id}} class="btn btn-success">Follow</a>
								@endif
							@endif
							<hr class="divider">

								@foreach ($user->tweets->reverse() as $tweet)
									@if($tweet->user->image!=null)
										<h3><img src="{!! '/images/'.$tweet->user->image->filePath !!}" width="30px;" height="20px;"><a href={{"/".$tweet->user->username}}> {{$tweet->user->username}}</a> tweeted:</h3>
									@else
										<h3><img src="/profile.png" width="30px;" height="20px;"><a href={{"/".$tweet->user->username}}> {{$tweet->user->username}}</a> tweeted:</h3>																					
									@endif
									<p>{{$tweet->tweet}}</p>
									<p>{{$tweet->country()->name}}</p>
									<p>{{$tweet->created_at}}</p>
									@if ($tweet->tweet_id>0)
									<p>Reposted</p>
									@elseif ($tweet->original_tweet_id>0)
									<p>Reply for this <a href="/tweet/{{$tweet->original_tweet_id}}">post</a></p>
									@endif
									<p>{{$tweet->likes()}} people like this and {{$tweet->repost_number()}} reposted this</p>
									@if($tweet->is_liked_by(Auth::user())==false)
										<form class="form-horizontal" role="form" method="POST" action="{{ url('/like') }}" style="float:left; margin-right:5px;">
									 		<input type="hidden" name="_token" value="{{ csrf_token() }}">
									 		<input type="hidden" name="user_id" value={{ Auth::user()->id }}>
											<input type="hidden" name="tweet_id" value={{ $tweet->id }}>
											<input type="submit" value="like" class="btn btn-success">
										</form>
			
									@else
										<a class='btn btn-danger' href="/unlike/{{Auth::user()->id}}/{{$tweet->id}}">Unlike</a>
									@endif
									@if(Auth::user()->username != $user->username)
										<a class='btn btn-primary' href="/repost/{{$tweet->id}}/{{Auth::user()->id}}">Repost</a>
									@endif
									<a class='btn btn-info'href="/reply;{{$tweet->id}}">Reply</a>
									<br>
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