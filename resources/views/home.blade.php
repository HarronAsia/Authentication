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
                            <th>Date</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                        <td>{{$event->id}}</td>
                        <td>
                            <div class="w3-border w3-padding">
                                <img src="{{asset('storage/event/'.$event->title.'/'.$event->photo.'/')}}" alt="Image" style="width:200px ;height:200px;" >
                            </div>
                        </td>
                        <td>{{$event->title}}</td>
                        <td>{{$event->created_at}}</td>
                        <td>{{$event->updated_at}}</td>
                        <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>


    </div>
</div>
@endsection