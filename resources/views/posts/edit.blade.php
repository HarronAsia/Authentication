@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">Go Back</a>
    <h1>Edit a new Post</h1>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST']) !!}
    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Enter your Title']) }}
    </div>

    <div class="form-group">
        {{ Form::label('detail', 'Detail') }}
        {{ Form::textarea('detail', $post->detail, ['class' => 'form-control', 'placeholder' => 'Enter Post Detail']) }}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}

@endsection