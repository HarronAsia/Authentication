@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <!-- Profile Page -->
        <div class="tab-pane container active" id="profile">

            <div class="card-deck">
                <div class="card border-primary">

                    <div class="card-header bg-primary text-light text-center lead">
                        YOUR PROFILE ID || {{$user->id}}
                    </div>

                    <div class="card-header bg-primary text-light text-center lead">
                    YOUR PROFILE IMAGE|| <br>
                    <img src="{{storage_path('app/public/'.$user->name.'/'.$user->photo)}}" alt="Image" style="width:200px ;height:200px;">
               
                    </div>

                    <div class="card-body">
                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                            <b> Your Profile Name : </b> {{$user->name}}
                        </p>

                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                            <b> Your Profile Email : </b> {{$user->email}}
                        </p>

                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                            <b> Role : </b> {{$user->role}}
                        </p>

                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                            <b> Created On : </b> {{$user->created_at}}
                        </p>

                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                            <b> Last Updated : </b> {{$user->updated_at}}
                        </p>

                    </div>

                </div>
                @if(Auth::user()->id == $user->id)
                <div class="card border-secondary">
                    <a href="/profile/edit/{{Auth::user()->id}}" class="btn btn-info">Edit Profile</a>
                </div>
                @endif
            </div>
        </div>
        <!-- Profile Page -->
    </div>
</div>
@endsection