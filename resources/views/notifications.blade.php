@extends('app')
@section('content')
<div id="fondo2">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-success">
					<div class="panel-heading text-center">Notifications</div>
						<div class="panel-body">
							@foreach ($notifications as $notification)
								<p>Tweet: {{App\Tweet::find($notification->tweet_id)->tweet}}</p>
								<p>Retweeted by: <a href={{'/'.App\User::find($notification->user_id)->username}}>{{App\User::find($notification->user_id)->username}}</a></p>
								
								<hr class="divider">
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@endsection
