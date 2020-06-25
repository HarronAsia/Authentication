@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Profile Page -->
        <a href="javascript:history.back()" class="btn btn-primary">Back</a>
        <form action="/profile/update/{{Auth::user()->id}} " method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="photo">Your Image</label>
            <input type ="file" class="form-control" name="photo" required>
        </div>

        <div class="form-group">
            <label for="name">Your name</label>
            <input class="form-control" name="name" placeholder="Enter Your Name" value="{{ $user->name}}" required>
        </div>

        <div class="form-group">
            <label for="dob">Your Birthday</label>
            <input type="date" class="form-control" name="dob" placeholder="Enter Your DOB"  value="{{ $user->dob }}" required>
        </div>

        <div class="form-group">
            <label for="number">Your Phone Number</label>
            <input type="tel" class="form-control" name="number"  placeholder="Enter Your Phone Number" value="{{ $user->number }}" required>
        </div>

        <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <!-- Profile Page -->
    </div>
</div>

@endsection