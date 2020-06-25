@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Profile Page -->
        <a href="javascript:history.back()" class="btn btn-primary">Back</a>
        <form action="/profile/update/{{Auth::user()->id}} " method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="photo">Upload Your Image</label>
            <input type ="file" class="form-control" name="photo" >
        </div>

        <div class="form-group">
            <label for="name">Edit your name</label>
            <input class="form-control" name="name" placeholder="Enter Your Name" value={{ $user->name }}>
        </div>

        <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <!-- Profile Page -->
    </div>
</div>

@endsection