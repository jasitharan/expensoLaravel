@extends('layouts.master')
@section('title','Expenses')
@section('expense-active','active')



@section('content')
<div class="card shadow-sm p-3 mb-5 bg-white rounded">
    <div class="card-header">
        <ul class="nav nav-tabs flex-row justify-content-start">
            <li class="nav-item">
              <a class="nav-link @yield('expense-list-active')" href="{{ url('expenses?sort=created_at&direction=desc') }}">Expense List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('expense-create-active')" href="{{ url('expenses/create') }}">Create Expense</a>
            </li>
            <li class="nav-item @yield('edit-hidden')">
              <a class="nav-link @yield('expense-edit-active')"> Edit Expense</a>
            </li>
          </ul>
    </div>
   @yield('expense-section')
  </div>
@endsection