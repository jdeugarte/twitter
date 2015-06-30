@extends('app')
@section('content')
<div id="fondo2">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-success">
					<div class="panel-heading text-center">Tweet</div>
						<div class="panel-body">
							@if(Auth::user()->image!=null)
									<h3><img src="{!! '/images/'.$user->image->filePath !!}" width="30px;" height="20px;"><a href={{"/".$tweet->user->username}}> {{$tweet->user->username}}</a> tweeted:</h3>
								@else
									<h3><img src="/profile.png" width="50px;"><a href={{"/".$tweet->user->username}}> {{$tweet->user->username}}</a> tweeted:</h3>
								@endif
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
								<a class='btn btn-info'href="\reply\{{$tweet->id}}">Reply</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@endsection
