@extends('layouts.master')
@section('title','Comments')
@section('comments-active','active')

@section('content')
<div class="card  shadow-sm p-3 mb-5 bg-white rounded">
    <div class="card-header">
        <ul class="nav nav-tabs flex-row justify-content-start">
            <li class="nav-item">
              <a class="nav-link  @yield('comment-list-active')"  href="{{ url('comments?sort=created_at&direction=desc') }}">Comments List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  @yield('comment-create-active')"  href="{{ url('comments/create') }}">Create Comment</a>
            </li>
            <li class="nav-item @yield('edit-hidden')">
              <a class="nav-link @yield('comment-edit-active')">Edit Category</a>
            </li>
          </ul>
    </div>
 {{-- content --}}
 
 @yield('comment-section')
 
 {{-- content end --}}
  </div>
@endsection