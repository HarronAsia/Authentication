@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Edit Event Page -->
        <a href="javascript:history.back()" class="btn btn-primary">Back</a>
        @if(Auth::user()->role == "manager")
        <form action="/manager/event/{{$event->id}}/update/confirm " method="POST" enctype="multipart/form-data">
            @else
            <form action="/admin/event/{{$event->id}}/update/confirm " method="POST" enctype="multipart/form-data">
                @endif
                @csrf

                <div class="form-group">
                    <label for="thumbnail">Upload Your Image</label>
                    <div>
                        <img src="{{asset('storage/event/'.$event->title.'/'.$event->thumbnail.'/')}}" alt="Image" style="max-width: 500px ; max-height:500px;">
                        &nbsp;&nbsp;<i class="fa fa-arrow-right" style="font-size:48px;"></i>&nbsp;&nbsp;
                        <img id="image_preview_container" src="#" alt="preview image" style="max-width: 500px ; max-height:500px;">
                    </div>
                    <input type="file" class="form-control" name="thumbnail" id="thumbnail">
                </div>

                <div class="form-group">
                    <label for="title">Edit Event Title</label>
                    <input class="form-control" name="title" placeholder="Enter Your title" value="{{ $event->title}}">
                </div>

                <div class="form-group">
                    <label for="detail">Edit Event Detail</label>
                    <input class="form-control" name="detail" placeholder="Enter Your detail" value="{{ $event->detail}}">
                </div>

                <div class="form-group">
                    <label for="event_start">Event Start At</label>
                    <input type="date" class="form-control" name="event_start" value="{{ $event->event_start}}">
                </div>

                <div class="form-group">
                    <label for="event_end">Event End At</label>
                    <input type="date" class="form-control" name="event_end" value="{{ $event->event_end}}">
                </div>

                <div class="form-group">
                    <label for="status" class="col-md-4 control-label">Status:</label>
                    <select class="form-control" name="status" id="status">
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <!--Edit Event Page -->
    </div>
</div>

@endsection