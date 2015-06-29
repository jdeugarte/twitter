@extends('app')

@section('content')
	@foreach ($user->tweets as $tweet)
		<h2>{{$tweet->user->username}} tweeted:</h2>
		<p>{{$tweet->tweet}}</p>
		<p>{{$tweet->created_at}}</p>
	@endforeach

@foreach ($user->following() as $id)
	@foreach (App\User::find($id)->tweets as $t)
		<h2>{{$t->user->username}} tweeted:</h2>
		<p>{{$t->tweet}}</p>
		<p>{{$t->created_at}}</p>
	@endforeach
@endforeach
@endsection
