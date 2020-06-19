@extends('layouts.app')


@section('content')
  
      <div class="card-body">
            <div class="table-responsive" id="showBlog">
               <ul class="navbar-nav mr-auto align-self-right" >
                  <a href="/posts/create" >
                        <i class="fas fa-plus-circle fa-lg"></i>&nbsp;&nbsp;Add Blog
                  </a>
               </ul>
            
               <table class="table table-striped text-center">
                  <thead>
                     <tr>
                        <th>No.</th>
                       <th>Title</th> 
                        <th>Details</th>
                        <th>Date</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                  @foreach($posts as $post)
                     <tr>
                           <td>{{$post->id}}</td>
                           <td><a href = "/posts/{{$post->id}}">{{$post->title}}</a></td>
                           <td>{{$post->detail}}</td>
                           <td>{{$post->created_at}}</td>
                           <td>{{$post->title}}</td>
                     </tr>
                     @endforeach
                  </tbody>
                  
               </table>

            </div>
         </div>
      

@endsection