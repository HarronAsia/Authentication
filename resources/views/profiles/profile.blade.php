@extends('layouts.app')


@section('content')

<div class="card-body">
                  <div class="tab-content">

                     <!-- Profile Page -->
                     <div class="tab-pane container active" id="profile">
  
                        <div class="card-deck">
                           <div class="card border-primary">
                             
                           <div class="card-header bg-primary text-light text-center lead">
                                 YOUR PROFILE ID || {{$user->id}}
                              </div>

                              <div class="card-header bg-primary text-light text-center lead">
                                  <img src="../../assets/images/uploaded/">
                              </div>

                              <div class="card-body">
                                 <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                    <b> Your Profile Name : </b>  {{$user->name}}
                                 </p>

                                 <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                    <b> Your Profile Email : </b> {{$user->email}}
                                 </p>

                              </div>
                        
                           </div>
                        </div>
                     </div>
                     <!-- Profile Page -->

@endsection