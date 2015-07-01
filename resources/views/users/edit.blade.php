@extends('app')
@section('content')
	<div id="fondo2">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-success">
					<div class="panel-heading text-center">Change Profile</div>
						<div class="panel-body">


						<form class="form-horizontal" role="form" method="POST" action="{{ url('/update_profile') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">


						<div class="form-group">
							<label class="col-md-4 control-label">Country</label>
							<div class="col-md-6">
								<select class="form-control" name="country_id">
								@foreach (App\Country::all() as $country)
									  <option value="{{$country->id}}">{{$country->name}}</option>
								@endforeach
								</select>
							</div>
						</div>


						
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
										
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection