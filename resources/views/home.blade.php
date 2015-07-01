@extends('app')
@section('content')
<div id="fondo2">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-success">
					<div class="panel-heading text-center">Newsfeed</div>
						<div class="panel-body">
							<h3 class="text-center">Trending Topics</h3>
								@if($words!=[])
									<center>
										@for($i=0;$i<count($words);$i++)
											{{"#".$words[$i]}}
											@if($i==4)
												<?php $i=count($words)?>
											@endif
										@endfor
									</center>
								@endif

							<hr class="divider">

							@foreach ($user->tweets as $tweet)
								@if(Auth::user()->image!=null)
									<h3><img src="{!! '/images/'.$user->image->filePath !!}" width="30px;" height="20px;"><a href={{"/".$tweet->user->username}}> {{$tweet->user->username}}</a> tweeted:</h3>
								@else
									<h3><img src="/profile.png" width="50px;"><a href={{"/".$tweet->user->username}}> {{$tweet->user->username}}</a> tweeted:</h3>
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
								<a class='btn btn-info'href="/reply/{{$tweet->id}}">Reply</a>
								<br>
								<hr class="divider">
							@endforeach


							@foreach ($user->following() as $id)
								@foreach (App\User::find($id)->tweets as $t)
									@if($t->user->image!=null)
										<h3><img src="{!! '/images/'.$t->user->image->filePath !!}" width="30px;" height="20px;"><a href={{"/".$t->user->username}}> {{$t->user->username}}</a> tweeted:</h3>
									@else
										<h3><img src="/profile.png" width="30px;" height="20px;"><a href={{"/".$t->user->username}}> {{$t->user->username}}</a> tweeted:</h3>												
									@endif
									<p>{{$t->tweet}}</p>
									<p>{{$t->country()->name}}</p>
									<p>{{$t->created_at}}</p>
									@if ($t->tweet_id>0)
									<p>Reposted</p>
									@elseif ($t->original_tweet_id>0)
									<p>Reply for this <a href="/tweet/{{$t->original_tweet_id}}">post</a></p>
									@endif
									<p>{{$t->likes()}} people like this and {{$t->repost_number()}} reposted this</p>
									@if($t->is_liked_by(Auth::user())==false)
										<form class="form-horizontal" role="form" method="POST" action="{{ url('/like') }}" style="float:left; margin-right:5px;">
									 		<input type="hidden" name="_token" value="{{ csrf_token() }}">
									 		<input type="hidden" name="user_id" value={{ Auth::user()->id }}>
											<input type="hidden" name="tweet_id" value={{ $t->id }}>
											<input type="submit" value="like" class="btn btn-success">
										</form>
									@else
										<a class='btn btn-danger' href="/unlike/{{Auth::user()->id}}/{{$t->id}}">Unlike</a>
									@endif
									@if(Auth::user()->username != $t->user->username)
										<a class='btn btn-primary' href="/repost/{{$t->id}}/{{Auth::user()->id}}">Repost</a>
									@endif
									<a class='btn btn-info'href="/reply/{{$t->id}}">Reply</a>
									<br>
									<hr class="divider">
								@endforeach
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
