@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">

        <div class="col-lg-12">

            <h4 class="text-center text-primary mt-2"> Share your events </h4>
        </div>
    </div>

    <div class="card border-primary">
        <h5 class="card-header bg-primary d-flex justify-content-between">
            <hr>

        </h5>

        <div class="card-body">
            <div class="table-responsive" id="showBlog">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Banner</th>
                            <th>Title</th>
                            <th>Detail</th>
                            <th>Date</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                        <td>{{$event->id}}</td>
                        <td>
                            <a href="/content/{{$event->id}}">
                                <img src="{{asset('storage/event/'.$event->title.'/'.$event->thumbnail.'/')}}" alt="Image" style="width:200px ;height:200px;">
                            </a>
                        </td>

                        <td>{{$event->title}}</td>
                        <td>{{$event->detail}}</td>
                        <td>{{$event->created_at}}</td>
                        <td>{{$event->updated_at}}</td>
                        <td>
                        @if( Auth::user()->id == $event->user_id)
                            <div class="pull-left">
                                <a href="/event/{{$event->id}}/edit">
                                    <button type="button" class="btn btn-info btn-lg">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </a>
                            </div>

                            <div class="pull-right">
                                <a href="/event/{{$event->id}}/delete">
                                    <button type="button" class="btn btn-danger btn-lg">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </a>
                            </div>
                         @endif
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>


    </div>
</div>
@endsection