@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Edit Event Page -->
        <a href="javascript:history.back()" class="btn btn-primary">Back</a>
        @if(Auth::user()->role == "manager")
        <form action="/manager/content/{{$content->id}}/update/confirm" method="POST" enctype="multipart/form-data">
        @else
        <form action="/admin/content/{{$content->id}}/update/confirm" method="POST" enctype="multipart/form-data">
        @endif
            @csrf

            <div class="form-group">        
                <label for="sub_photo">Upload Your Image</label>
                <div>
                    <img src="{{asset('storage/event/'.$event->title.'/content'.'/'.$content->sub_title.'/'.$content->sub_photo.'/')}}" alt="Image" style="max-width: 500px ; max-height:500px;">
                    &nbsp;&nbsp;<i class="fa fa-arrow-right" style="font-size:48px;"></i>&nbsp;&nbsp;
                    <img id="image_preview_container" src="#" alt="preview Content Image" style="max-width: 500px ; max-height:500px;">
                    
                    <input type="file" class="form-control" name="sub_photo" id="sub_photo">
                </div>
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