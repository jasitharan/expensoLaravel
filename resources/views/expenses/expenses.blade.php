@extends('layouts.master')
@section('title','News')
@section('news-active','active')

@section('content')
<div class="card shadow-sm p-3 mb-5 bg-white rounded">
    <div class="card-header">
        <ul class="nav nav-tabs flex-row justify-content-start">
            <li class="nav-item">
              <a class="nav-link @yield('news-list-active')" href="{{ url('news?sort=created_at&direction=desc') }}">News List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('news-create-active')" href="{{ url('news/create') }}">Create News</a>
            </li>
            <li class="nav-item @yield('edit-hidden')">
              <a class="nav-link @yield('news-edit-active')"> Edit News</a>
            </li>
          </ul>
    </div>
   @yield('news-section')
  </div>
@endsection