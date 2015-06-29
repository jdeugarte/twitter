@extends('app')
@section('content') 
	<h1 class="well well-lg">All Image List</h1>
	@foreach( $images as $image )
    	<img src="{!! '/images/'.$image->filePath !!}">
	@endforeach
@endsection