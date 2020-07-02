@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <a href="javascript:history.back()" class="btn btn-primary">Back</a>
        <h1>WELCOME {{Auth::user()->name}}</h1>

        <h3>Let's review and confirm your content before edit to the website</h3>

        <h3 style="color: red;"><b>Don't worry the information here can only be seen by you !</b></h3>

        <h1 align="center">Confirmation page</h1>

        
        <!-- SUbmit Form -->
        @if(Auth::user()->role == "manager")
        <form action="/manager/content/{{$content['id']}}/update" method="POST" enctype="multipart/form-data" align="center">
            @else
            <form action="/admin/content/{{$content['id']}}/update" method="POST" enctype="multipart/form-data" align="center">
                @endif

                @csrf
                <div class="form-group">
                    <label for="sub_title">Content Title</label>
                    <div>{{$content['sub_title']}}</div>
                </div>

                <div class="form-group">
                    <label for="sub_detail">Event Detail</label>
                    <div>{{$content['sub_detail']}}</div>
                </div>

                <div class="form-group">
                    <div>
                        <label for="thumbnail">Upload Your Content image</label>
                        <div>
                            <img src="{{asset('storage/event/'.$event->title.'/content'.'/'.$content['sub_title'].'/'.$content['sub_photo'])}}" alt="preview image" style="max-width: 500px ; max-height:500px;">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" class="form-control form-control-lg" class="btn btn-success btn-block btn-lg">
                </div>
            </form>
            <!-- SUbmit Form -->
    </div>
</div>

@endsection