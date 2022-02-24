@extends('layouts.master')
@section('title','Pending Expenses')
@section('pending_expenses-active','active')


@section('content')
<div class="card shadow-sm p-3 mb-5 bg-white rounded">
    <div class="card-header">
        <ul class="nav nav-tabs flex-row justify-content-start">
            <li class="nav-item">
              <a class="nav-link @yield('pending_expenses-list-active')" href="{{ url('pending_expenses?sort=created_at&direction=desc') }}">Expense List</a>
            </li>
          </ul>
    </div>
   @yield('pending_expenses-section')
  </div>
@endsection