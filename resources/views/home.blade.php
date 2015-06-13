@extends('app')

@section('content')
	@foreach ($tweets as $t)
		<p><a href="/{{$t->user()->username}}">{{$t->user()->username}}</a> {{$t->tweet}}</p>
	@endforeach
@endsection
