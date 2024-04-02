@extends('layouts.master')

@section('title','Category')

@section('content')


<div class="container-fluid px-4">
    <div class="row">
                        <h1 class="mt-4">View Category<a href="{{ route('admin.addcategory') }}" class="btn btn-primary float-end">Add Category</a></h1><br>
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
                               <th>Category Name</th>
                               <th>Image</th>
                               <th>Status</th>
                               <th>Action</th>
                            </tr>
                          </thead>
                           
                          <tbody>
                          @foreach($categories as $category)
                             <tr>
                               <td>{{ $category->id }}</td>
                               <td>{{ $category->name }}</td>
                               <td>
                                  <img src="{{ asset('uploads/category/'.$category->image)}}" height="50px" width="50px" alt="alt"/>
                               </td>
                               <td>{{ $category->status == 1 ? 'Hidden' : 'Shown'}}</td>
                               <td>
                                   <a href="" class="btn btn-success">Edit</a>
                                   <a href="" class="btn btn-danger">Delete</a>
                                   {{-- <button type="button" value="{{ $category->id }}" class="btn btn-danger deleteCategoryBtn">Delete</button> --}}
                               </td>
                             </tr>
                          @endforeach
                          </tbody>
                       </table>
                      </div>
</div>

@endsection
