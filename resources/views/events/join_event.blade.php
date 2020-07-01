@extends('layouts.app')

@section('content')

<a href="javascript:history.back()" class="btn btn-primary">Back</a>
<div class="container-fluid">
    <div class="row justify-content-center">
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

    <div class="row justify-content-center">
        <!-- Profile Page -->
        @if(Auth::user()->role == "manager")
        <form action="/manager/event/{{$event->id}}/participate" method="GET">
        @else
        <form action="/admin/event/{{$event->id}}/participate" method="GET">
        @endif
            @csrf
                <div class="tab-pane container active" id="profile">

                    <div class="card-deck">
                        <div class="card border-primary">

                            <div class="card-header bg-primary text-light text-center lead">
                                YOUR PROFILE ID || {{Auth::user()->id}}
                            </div>

                            <div class="card-body">
                                <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                    <b> Your Profile Name : </b> {{Auth::user()->name}}
                                </p>

                                <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                    <b> Your Profile Email : </b> {{Auth::user()->email}}
                                </p>

                                <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                    <b> Role : </b> {{Auth::user()->role}}
                                </p>

                                <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                    <b> Day Of Birth : </b> {{Auth::user()->dob}}
                                </p>

                                <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                    <b> Phone Number : </b> {{Auth::user()->number}}
                                </p>

                                <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                    <b> Created On : </b> {{Auth::user()->created_at}}
                                </p>


                            </div>

                        </div>

                    </div>
                </div>
                @if (Auth::user()->join_id == $event->id)

                @else
                    @if($event->count_id == 10)
                        
                    @else
                        @if (Auth::user()->id == $event->user_id)

                        @else
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i>&nbsp;&nbsp;Join Event
                            </button>
                        @endif                   
                    @endif
                @endif
            </form>

    </div>
    <!-- Profile Page -->
</div>

<div class="row justify-content-center">
    <div class="card-header" >
        <h1> &nbsp;&nbsp;Total Number: {{$numbers}} &nbsp;&nbsp;<i class="fa fa-users"></i></h1>
        
    </div>
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
                                    <i class="fa fa-info"></i>
                                </button>&nbsp;&nbsp;
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