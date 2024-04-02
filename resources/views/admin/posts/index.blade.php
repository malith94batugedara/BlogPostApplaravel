@extends('layouts.master')

@section('title','Posts')

@section('content')

<div class="container-fluid px-4">
    <div class="row">
                        <h1 class="mt-4">View Posts  <a href="{{ route('admin.addposts') }}" class="btn btn-primary float-end">Add Post</a></h1><br>
    </div><br>
                        @if(session('status'))
                            <div class="alert alert-success">
                                  {{ session('status') }}
                            </div>
                        @endif
                      <div class="table-responsive">
                       <table class="table table-dark">
                          <thead>
                            <tr>
                               <th>ID</th>
                               <th>Category</th>
                               <th>Post Name</th>
                               <th>Status</th>
                               <th>Action</th>
                            </tr>
                          </thead>
                           
                          <tbody>
                             @foreach($posts as $post)
                             <tr>
                               <td>{{$post->id}}</td>
                               <td>{{$post->category->name}}</td>
                               <td>{{$post->name}}</td>
                               <td>{{ $post->status == 1 ? 'Hidden' : 'Shown' ;}}</td>
                               <td>
                                   <a href="{{ route('admin.editpost',$post->id) }}" class="btn btn-success">Edit</a>
                                   <a href="{{ route('admin.deletepost',$post->id) }}" class="btn btn-danger">Delete</a>
                               </td>
                             </tr>
                             @endforeach
                          </tbody>
                       </table>
                      </div>
</div>

@endsection