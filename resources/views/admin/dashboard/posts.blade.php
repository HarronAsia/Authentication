@extends('layouts.app')

@section('content')

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col">
            @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{Session('message')}}
            </div>
            @endif

            @if(Session::has('delete-message'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{Session('delete-message')}}
            </div>
            @endif
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('events.add_event') }}" class="btn btn-sm btn-primary float-right">
                        Add New Event
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" width="60">No.</th>
                                <th scope="col" width="60">Thumbnail</th>
                                <th scope="col" width="60">Title</th>
                                <th scope="col" width="60">Detail</th>
                                <th scope="col" width="60">Created On</th>
                                <th scope="col" width="60">Created By</th>
                                <th scope="col" width="60">Action By</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>{{ $events->id}}</td>
                                <td>{{ $events->thumbnail}}</td>
                                <td>{{ $events->title}}</td>
                                <td>{{ $events->detail}}</td>
                                <td>{{ $events->created_at}}</td>
                                <td>{{ $events->user->name}}</td>
                                <td>
                                    <a href="{{ route('events.edit', $event->id }}" class="btn btn-sm btn-primary" title="Edit Event">
                                        Edit Event
                                    </a>

                                    {!! Form::open(['route' => ['events.delete', $event->id], 'method' => 'delete', 'style' => 'display:inline']) !!}
                                    {!! Form::submit('Delete Event', ['class' => 'btn btn-sm btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection