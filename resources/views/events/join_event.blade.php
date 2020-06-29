@extends('layouts.app')

@section('content')

<a href="javascript:history.back()" class="btn btn-primary">Back</a>
<div class="container">
    <div class="row">
        <!-- Post Content Column -->
        <div class="col-lg-8">

            <!-- Title -->
            <h1 class="mt-4">{{$event->title}}</h1>


            <hr>

            <!-- Date/Time -->
            <p>Posted on {{$event->created_at}}</p>

            <hr>
            <!-- Event Image -->
            <img src="{{asset('storage/event/'.$event->title.'/'.$event->thumbnail.'/')}}" alt="Image">

            <hr>

            <!-- Event Detail -->
            <p class="lead">{{$event->detail}}</p>

        </div>
    </div>

    

    <div class="row">
        <div class="card-body">
            <div class="table-responsive" id="showBlog">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <td>{{$user->id}}</td>
                        <td>
                            @if ($user->photo == NULL)
                            <img src="{{asset('storage/default.png')}}" alt="Image" style="width:200px ;height:200px;">
                            @else
                            <img src="{{asset('storage/'.$user->name.'/'.$user->photo)}}" alt="Image" style="width:200px ;height:200px;">
                            @endif
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>

                        <td>
                            <div class="pull-left">
                                <a href="#">
                                    <button type="button" class="btn btn-info btn-lg">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </a>
                            </div>

                            <div class="pull-left">
                                <a href="#">
                                    <button type="button" class="btn btn-danger btn-lg">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </a>
                            </div>

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