@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="container">
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h4 class="modal-title text-light">Add Blog</h4>
                    </div>

                    <div class="modal-body">
                        <form action="/event/update" method="POST" class="px-3" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <input type="text" name="title" class="form-control form-control-lg" placeholder="Enter Title" required>
                            </div>

                            <div class="form-group">
                                <label for="photo">Upload Your Banner image</label>
                                <input type="file" class="form-control" name="photo">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="addevent" class="form-control form-control-lg" value="Add Event" class="btn btn-success btn-block btn-lg">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
   
    </div>
</div>
@endsection