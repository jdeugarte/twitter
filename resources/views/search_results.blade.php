@extends('app')
@section('content')
<div id="fondo2">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-success">
					<div class="panel-heading text-center">Search Results</div>
					<div class="panel-body">
						<h3>Users:</h3>
							@if ($users!=null)
								@foreach ($users as $user)
									<p><a href={{"/".$user->username}}>{{$user->username}}</a></p>
								@endforeach
							@else
								<h1>No hay resultados</h1>
							@endif

						<hr class="divider">

						<h3>Tweets:</h3>
						<hr class="divider">
						@if ($tweets!=null)
							@foreach ($tweets as $tweet)
								<p><a href={{"/".$tweet->user->username}}>{{$tweet->user->username}}</a> tweeted:</p>
								<p>{{$tweet->tweet}}</p>
								<p>{{$tweet->created_at}}</p>
								<hr class="divider">
							@endforeach
						@else
							<h1>No hay resultados</h1>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection