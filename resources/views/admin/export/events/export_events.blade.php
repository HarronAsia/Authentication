@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card-header" align="center">
            <a href="/admin/export/events" class="btn btn-success">
                <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Export Event
            </a>
            <hr>
            
        </div>
        <form method="post" action="/admin/import/events" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="excel">Your Sheet file</label>
                    <input type="file" class="form-control" name="excel">
                </div>
                <br />
                <button type="submit" class="btn btn-success">Import Event</button>
            </form>
        <div class="card-body">
            <div class="table-responsive" id="showBlog">
                <div class="card-body">
                    <div class="table-responsive" id="showBlog">
                        <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Owner ID</th>
                                    <th>Detail</th>
                                    <th>Created At</th>
                                    <th>Last Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                <tr>
                                    <td>{{$event->id}}</td>
                                    <td>
                                        <div>
                                            {{$event->title}}
                                        </div>
                                    </td>
                                    <td>{{$event->user_id}}</td>
                                    <td>{{$event->detail}}</td>
                                    <td>{{$event->created_at}}</td>
                                    <td>{{$event->updated_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection