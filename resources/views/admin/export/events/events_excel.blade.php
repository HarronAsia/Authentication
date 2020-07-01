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