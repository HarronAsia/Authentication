@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <!-- Edit Event Page -->
        <a href="javascript:history.back()" class="btn btn-primary">Back</a>
        <form action="/content/{{$content->id}}/update" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="sub_photo">Upload Your Image</label>
            
                <input type="file" class="form-control" name="sub_photo">
            </div>

            <div class="form-group">
                <label for="sub_title">Edit Event Title</label>
                <input class="form-control" name="sub_title" placeholder="Enter Your title" value="{{$content->sub_title}}">
            </div>

            <div class="form-group">
                <label for="sub_detail">Edit Event Detail</label>
                <input class="form-control" name="sub_detail" placeholder="Enter Your detail" value="{{$content->sub_detail}}">
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <!--Edit Event Page -->
    </div>
</div>

@endsection