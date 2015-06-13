@extends('layout')
@section('content')
{!! Form::open(['url'=>'tweets']) !!}
{!! Form::label('name','Tweet:') !!}
{!! Form::text('tweet') !!}
<br>
{!! Form::submit('Guardar') !!}
{!! Form::close() !!}
@if ($errors->any())
	@foreach($errors -> all() as $error)
		{{$error}}
	@endforeach
@endif
@stop