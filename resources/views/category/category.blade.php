@extends('layouts.master')
@section('title','Category')
@section('category-active','active')

@section('content')
<div class="card  shadow-sm p-3 mb-5 bg-white rounded">
    <div class="card-header">
        <ul class="nav nav-tabs flex-row justify-content-start">
            <li class="nav-item">
              <a class="nav-link @yield('category-list-active')" href="{{ url('/category?sort=created_at&direction=desc') }}">Categories List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('category-create-active')" href="{{ url('/category/create') }}">Create Category</a>
            </li>
            <li class="nav-item @yield('edit-hidden')">
              <a class="nav-link @yield('category-edit-active')" href="{{ url('/category/edit') }}">Edit Category</a>
            </li>
          </ul>
    </div>
    @yield('category-section')
  </div>
@endsection