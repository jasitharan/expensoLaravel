@extends('layouts.master')
@section('title','Companies')
@section('companies-active','active')

@section('content')
<div class="card  shadow-sm p-3 mb-5 bg-white rounded">
    <div class="card-header">
        <ul class="nav nav-tabs flex-row justify-content-start">
            <li class="nav-item">
              <a class="nav-link @yield('companies-list-active')" href="{{ url('/companies?sort=created_at&direction=desc') }}">Companies List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('companies-create-active')" href="{{ url('/companies/create') }}">Create Company</a>
            </li>
            <li class="nav-item @yield('edit-hidden')">
              <a class="nav-link @yield('companies-edit-active')" href="{{ url('/companies/edit') }}">Edit Company</a>
            </li>
          </ul>
    </div>
    @yield('companies-section')
  </div>
@endsection