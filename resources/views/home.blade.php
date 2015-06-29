@extends('app')
@section('content')
<div id="fondo2">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-success">
					<div class="panel-heading text-center">Newsfeed</div>
						<div class="panel-body">
							@foreach ($user->tweets as $tweet)
								<h3><a href={{"/".$tweet->user->username}}> {{$tweet->user->username}}</a> tweeted:</h3>
								<p>{{$tweet->tweet}}</p>
								<p>{{$tweet->created_at}}</p>
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
								<br>
								<hr class="divider">
							@endforeach


							@foreach ($user->following() as $id)
								@foreach (App\User::find($id)->tweets as $t)
									<h3><a href={{"/".$t->user->username}}> {{$t->user->username}}</a> tweeted:</h3>
									<p>{{$t->tweet}}</p>
									<p>{{$t->created_at}}</p>
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
