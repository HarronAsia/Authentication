@extends('layouts.app')

@section('content')
<a href="javascript:history.back()" class="btn btn-primary">Back</a>
<div class="container-fluid">
    <div class="row justify-content-center">
        <!-- Post Content Column -->
        <div class="col-lg-8">

            <!-- Title -->
            <h1 class="mt-4">{{$event->title}}</h1>

            <!-- Author -->


            @if( Auth::user()->id == $event->user_id)
            <p class="lead">
                by
                <h2>{{$user->name}}</h2>

            </p>
            @else
            <p class="lead">
                by
                <a href="/profile/{{$event->user_id}}">{{$user->name}}</a>

            </p>
            @endif

            <hr>
            <!-- Date/Time -->
            <p>Posted on {{$event->created_at}}</p>

            <hr>
            @if (Auth::user()->role == "member")

            @else
            @if (Auth::user()->role == "manager")
            <a href="/manager/event/{{$event->id}}/join" class="btn btn-success">Join Event</a>
            @else
            <a href="/admin/event/{{$event->id}}/join" class="btn btn-success">Join Event</a>
            @endif
            @endif

            <!-- Event Image -->
            <img src="{{asset('storage/event/'.$event->title.'/'.$event->thumbnail.'/')}}" alt="Image">

            <hr>

            <!-- Event Detail -->
            <p class="lead">{{$event->detail}}</p>

            @if (Auth::user()->role == "member")

            @else

            @if (Auth::user()->role == "manager")
            @if( Auth::user()->id == $event->user_id)
            <!-- Add Content -->
            <a href="/manager/content/{{$event->id}}/add" class="btn btn-success">Add More Contents</a>
            @else

            @endif
            @else
            <a href="/admin/content/{{$event->id}}/add" class="btn btn-success">Add More Contents</a>
            @endif
            @endif

        </div>

    </div>
    <!-- /.row -->

    <div class="row">
        <div class="card-body">
            <div class="table-responsive" id="showBlog">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Photo</th>
                            <th>Title</th>
                            <th>Detail</th>
                            <th>Date</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contents as $content)
                        <td>{{$content->id}}</td>
                        <td>
                            <img src="{{asset('storage/event/'.$event->title.'/content'.'/'.$content->sub_title.'/'.$content->sub_photo.'/')}}" alt="Image" style="width:200px ;height:200px;">
                        </td>
                        <td>{{$content->sub_title}}</td>
                        <td>{{$content->sub_detail}}</td>
                        <td>{{$content->created_at}}</td>
                        <td>{{$content->updated_at}}</td>
                        <td>
                            @if (Auth::user()->role == "member")

                            @elseif (Auth::user()->role == "manager")

                            @can('update', $event)
                            <div class="pull-left">
                                <a href="/manager/content/{{$content->id}}/edit">
                                    <button type="button" class="btn btn-info btn-lg">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </a>
                            </div>
                            @endcan

                            @cannot('update-event', $event)

                            @endcannot

                            @can('delete', $event)
                            <div class="pull-left">
                                <a href="/manager/content/{{$content->id}}/delete">
                                    <button type="button" class="btn btn-danger btn-lg">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </a>
                            </div>
                            @endcan

                            @cannot('delete-event', $event)

                            @endcannot

                            @else
                            <div class="pull-left">
                                <a href="/admin/content/{{$content->id}}/edit">
                                    <button type="button" class="btn btn-info btn-lg">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </a>
                            </div>

                            <div class="pull-left">
                                <a href="/admin/content/{{$content->id}}/delete">
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