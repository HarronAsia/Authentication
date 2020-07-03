@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <a href="javascript:history.back()" class="btn btn-primary">Back</a>

        <div class="container">
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h4 class="modal-title text-light">Add Event</h4>
                    </div>

                    <div class="modal-body">

                        @if(Auth::user()->role == "manager")
                        <form action="/manager/event/add/confirm" method="POST" enctype="multipart/form-data">
                            @else
                            <form action="/admin/event/add/confirm" method="POST" enctype="multipart/form-data">
                                @endif

                                @csrf
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control form-control-lg" placeholder="Enter Title" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="detail" class="form-control form-control-lg" placeholder="Enter Detail" required>
                                </div>


                                <div class="form-group">

                                    <img id="image_preview_container" src="https://lh3.googleusercontent.com/proxy/h_jSrzd_LTroD-A82cpQNw5WJuZ9ibHb85B4EJV7o3IV59vRCF0l8qnOmu1y0iAvV_SIZfJQ_2xNH0YJubL7uFK-pa0ktFsb5O9MuY0utqFwjo1UGzEej48u" alt="preview Banner" style="max-width: 500px ; max-height:500px;">
                                    <div>
                                        <label for="thumbnail">Upload Your Banner image</label>
                                        <input type="file" class="form-control" name="thumbnail" id="thumbnail">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="event_start">Event Start At</label>
                                    <input type="date" class="form-control" name="event_start">
                                </div>

                                <div class="form-group">
                                    <label for="event_end">Event End At</label>
                                    <input type="date" class="form-control" name="event_end">
                                </div>

                                <div class="form-group">
                                    <label for="status" class="col-md-4 control-label">Status:</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="public">Public</option>
                                        <option value="private">Private</option>
                                    </select>
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