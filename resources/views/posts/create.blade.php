@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">Go Back</a>
    <h1>Create a new Post</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST']) !!}
    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Enter your Title']) }}
    </div>

    <div class="form-group">
        {{ Form::label('detail', 'Detail') }}
        {{ Form::textarea('detail', '', ['class' => 'form-control', 'placeholder' => 'Enter Post Detail']) }}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}

@endsection