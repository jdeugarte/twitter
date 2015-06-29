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
								<hr class="divider">
							@endforeach


							@foreach ($user->following() as $id)
								@foreach (App\User::find($id)->tweets as $t)
									<h3><a href={{"/".$t->user->username}}> {{$t->user->username}}</a> tweeted:</h3>
									<p>{{$t->tweet}}</p>
									<p>{{$t->created_at}}</p>
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
