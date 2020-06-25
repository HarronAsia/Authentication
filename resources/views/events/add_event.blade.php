@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <a href="javascript:history.back()" class="btn btn-primary">Back</a>

        <div class="container">
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h4 class="modal-title text-light">Add Event</h4>
                    </div>

                    <div class="modal-body">
                        <form action="/event/create" method="POST" class="px-3" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="title" class="form-control form-control-lg" placeholder="Enter Title" required>
                            </div>

                            <div class="form-group">
                                <textarea name="detail" class="form-control form-control-lg" placeholder="Enter Detail" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="thumbnail">Upload Your Banner image</label>
                                <input type="file" class="form-control" name="thumbnail">
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