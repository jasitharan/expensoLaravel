@extends('layouts.master')
@section('title','Users')
@section('users-active','active')

@section('content')
<div class="card shadow-sm p-3 mb-5 bg-white rounded">
    <div class="card-header">
        <ul class="nav nav-tabs flex-row justify-content-start">
            <li class="nav-item">
              <a class="nav-link @yield('users-list-active')" href="{{ url('users?sort=created_at&direction=desc') }}">User List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('users-create-active')" href="{{ url('users/create') }}">Create User</a>
            </li>
            <li class="nav-item @yield('edit-hidden')">
              <a class="nav-link @yield('users-edit-active')"> Edit User</a>
            </li>
          </ul>
    </div>
   @yield('users-section')
  </div>
@endsection