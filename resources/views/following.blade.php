@extends('app')
@section('content')
<div id="fondo2">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-success">
					<div class="panel-heading text-center">Users You're Following</div>
						<div class="panel-body">
							@foreach ($user->following() as $id)
								<h3><a href={{"/".App\User::find($id)->username}}> {{App\User::find($id)->username}}</a></h3>
							@endforeach						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection