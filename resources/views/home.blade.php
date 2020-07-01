@extends('layouts.app')

@section('content')

@if(Auth::user()->email_verified_at == NULL)
    <script>window.location = "/email/verify";</script>
@else
<div class="container-fluid">
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
  
                        @if ($event->status == "private")
                            @if( Auth::user()->role == "admin")
                        <tr>
                            <td>{{$event->id}}</td>
                            <td>
                                <a href="/event/{{$event->id}}">
                                    <img src="{{asset('storage/event/'.$event->title.'/'.$event->thumbnail.'/')}}" alt="Image" style="width:200px ;height:200px;">
                                </a>
                            </td>

                            <td>
                                <div>
                                    {{$event->title}}
                                </div>
                            </td>
                            <td>{{$event->detail}}</td>
                            <td>{{$event->created_at}}</td>
                            <td>{{$event->updated_at}}</td>
                            <td>

                                <div class="pull-left">
                                    <a href="/admin/event/{{$event->id}}/edit">
                                        <button type="button" class="btn btn-info btn-lg">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                </div>

                                <div class="pull-right">
                                    <a href="/admin/event/{{$event->id}}/delete">
                                        <button type="button" class="btn btn-danger btn-lg">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </a>
                                </div>

                            </td>
                        </tr>
                            @endif
                        @else
                        <tr>
                            <td>{{$event->id}}</td>
                            <td>
                                <a href="/event/{{$event->id}}">
                                    <img src="{{asset('storage/event/'.$event->title.'/'.$event->thumbnail.'/')}}" alt="Image" style="width:200px ;height:200px;">
                                </a>
                            </td>

                            <td>
                                <div>
                                    {{$event->title}}
                                </div>
                            </td>
                            <td>{{$event->detail}}</td>
                            <td>{{$event->created_at}}</td>
                            <td>{{$event->updated_at}}</td>
                            <td>
                                @if( Auth::user()->role == "manager")
                                    @if( Auth::user()->id == $event->user_id)
                                    <div class="pull-left">
                                        <a href="/manager/event/{{$event->id}}/edit">
                                            <button type="button" class="btn btn-info btn-lg">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </a>
                                    </div>

                                    <div class="pull-right">
                                        <a href="/manager/event/{{$event->id}}/delete">
                                            <button type="button" class="btn btn-danger btn-lg">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </a>
                                    </div>
                                    @endif
                                @elseif ( Auth::user()->role == "admin")
                                    <div class="pull-left">
                                        <a href="/admin/event/{{$event->id}}/edit">
                                            <button type="button" class="btn btn-info btn-lg">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </a>
                                    </div>

                                    <div class="pull-right">
                                        <a href="/admin/event/{{$event->id}}/delete">
                                            <button type="button" class="btn btn-danger btn-lg">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </a>
                                    </div>
                                @else

                                @endif
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        {{ $events->links() }}

    </div>
</div>
@endif
@endsection