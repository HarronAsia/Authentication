@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <h1>WELCOME {{Auth::user()->name}}</h1>

        <h2>Let's review and confirm your account before using the website</h2>

        <h3>Don't worry the information here can only be seen by you !</h3>

        <h4>Confirmation page</h4>

        <div>
            <label for="thumbnail">Your Account Avatar</label>
            <img src="{{asset('storage/event/'.$event->title.'/'.$event->thumbnail.'/')}}" alt="Image" style="width:200px ;height:200px;">
            <input type="file" class="form-control" name="thumbnail">
        </div>

        <div>
            <label for="name">Your account Name</label>
            <input class="form-control" name="name" placeholder="Enter Your title" value="{{Auth::user()->name}}">
        </div>

        <div>
            <label for="email">Your Account Email</label>
            <input class="form-control" name="email" placeholder="Enter Your detail" value="{{Auth::user()->email}}">
        </div>

        <div>
            <label for="email">YourPhone Number</label>
            <input class="form-control" name="email" placeholder="Enter Your detail" value="{{Auth::user()->number}}">
        </div>

        <div>
            <label for="email">Your Date Of Birth</label>
            <input class="form-control" name="email" placeholder="Enter Your detail" value="{{Auth::user()->dob}}">
        </div>

        <div>
            <label for="email">Your Account Role</label>
            <input class="form-control" name="email" placeholder="Enter Your detail" value="{{Auth::user()->role}}">
        </div>
    </div>
</div>

@endsection