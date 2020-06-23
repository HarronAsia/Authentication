@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="column">
            <img src="{{asset('storage/event/'.$event->title.'/'.$event->photo.'/')}}" alt="Image" style="width:200px ;height:300px;">
            <hr>
            <div class="card border-primary">
                <h1 class="card-header  justify-content-between">
                    {{$event->title}}
                </h1>
            </div>


            <hr>
            <!-- Status -->
            <a href="/content/{{$event->id}}/add">
                <button class="bg-info">Add Contents</button>
            </a>
        </div>

        <div class="column">
            <div class="card-body">
                <div class="table-responsive" id="showBlog">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Addition photo</th>
                                <th>Detail</th>
                                <th>Date</th>
                                <th>Last Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($event as $content)
                            <td>1</td>
                            <td>
                                <a href="/content/{{$event->id}}">
                                    <img src="{{asset('storage/event/'.$event->title.'/'.$event->photo.'/')}}" alt="Image" style="width:200px ;height:200px;">
                                </a>
                            </td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection