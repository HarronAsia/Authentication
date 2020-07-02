@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
    <a href="javascript:history.back()" class="btn btn-primary">Back</a>

        <div class="container">
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h4 class="modal-title text-light">Add Content</h4>
                    </div>

                    <div class="modal-body">
                    @if (Auth::user()->role == "manager")
                    <!-- Add Content -->
                    <form action="/manager/content/{{$event->id}}/add/confirm" method="POST" class="px-3" enctype="multipart/form-data">
                    @else
                    <form action="/admin/content/{{$event->id}}/add/confirm" method="POST" class="px-3" enctype="multipart/form-data">
                    @endif
                        
                            @csrf
                            <div class="form-group">
                                <input type="text" name="sub_title" class="form-control form-control-lg" placeholder="Enter Title" required>
                            </div>

                            <div class="form-group">
                                <textarea name="sub_detail" class="form-control form-control-lg" placeholder="Enter Detail" required></textarea>
                            </div>

                            <div class="form-group">
                                <img id="image_preview_container" src="#" alt="preview Content Image" style="max-width: 500px ; max-height:500px;">
                                <div>
                                    <label for="sub_photo">Upload Your Content image</label>
                                    <input type="file" class="form-control" name="sub_photo" id="sub_photo" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <input type="submit" class="form-control form-control-lg" class="btn btn-success btn-block btn-lg">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection