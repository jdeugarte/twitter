@extends('app')
@section('content')    
 <div id="fondo2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-success">
                    <div class="panel-heading text-center">Profile Picture</div>

                    <div class="panel-body">
                        @if(isset($success))
                            <div class="alert alert-success"> {{$success}} </div>
                        @endif

                        {!! Form::open(['action'=>'ImageController@store', 'files'=>true]) !!}

                        <div class="form-group">
                            {!! Form::label('title', 'Title:') !!}
                            {!! Form::text('title', null, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Description:') !!}
                            {!! Form::textarea('description', null, ['class'=>'form-control', 'rows'=>5] ) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('image', 'Choose an image') !!}
                            {!! Form::file('image') !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Upload', array( 'class'=>'btn btn-danger form-control' )) !!}
                        </div>

                        {!! Form::close() !!}
                        <div class="alert-warning">
                            @foreach( $errors->all() as $error )
                               <br> {{ $error }}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection