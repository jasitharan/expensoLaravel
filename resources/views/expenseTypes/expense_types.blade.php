@extends('layouts.master')
@section('title','ExpenseTypes')
@section('expense_types-active','active')

@section('content')
<div class="card  shadow-sm p-3 mb-5 bg-white rounded">
    <div class="card-header">
        <ul class="nav nav-tabs flex-row justify-content-start">
            <li class="nav-item">
              <a class="nav-link @yield('expense_types-list-active')" href="{{ url('/expense_types?sort=created_at&direction=desc') }}">ExpenseType List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('expense_types-create-active')" href="{{ url('/expense_types/create') }}">Create ExpenseType</a>
            </li>
            <li class="nav-item @yield('edit-hidden')">
              <a class="nav-link @yield('expense_types-edit-active')" href="{{ url('/expense_types/edit') }}">Edit ExpenseType</a>
            </li>
          </ul>
    </div>
    @yield('expense_types-section')
  </div>
@endsection