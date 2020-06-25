@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Edit Event Page -->
        <a href="javascript:history.back()" class="btn btn-primary">Back</a>
        <form action="/manager/event/{{$event->id}}/update " method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="thumbnail">Upload Your Image</label>
                <img src="{{asset('storage/event/'.$event->title.'/'.$event->thumbnail.'/')}}" alt="Image" style="width:200px ;height:200px;">
                <input type="file" class="form-control" name="thumbnail">
            </div>

            <div class="form-group">
                <label for="title">Edit Event Title</label>
                <input class="form-control" name="title" placeholder="Enter Your title" value="{{ $event->title}}">
            </div>

            <div class="form-group">
                <label for="detail">Edit Event Detail</label>
                <input class="form-control" name="detail" placeholder="Enter Your detail" value="{{ $event->detail}}">
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <!--Edit Event Page -->
    </div>
</div>

@endsection