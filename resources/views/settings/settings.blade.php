@extends('layouts.master')
@section('title','Settings')
@section('settings-active','active')

@section('content')
<div class="container">

  <div class="row gutters-sm">
    <div class="col-md-4">
      <div class="card shadow-sm p-3 mb-5 bg-white rounded">
        <div class="card-body">
          <nav class="nav flex-column nav-pills nav-gap-y-1">
            <div>
              <h6 class="dropdown-header">Select Setting</h6>
              <a class="dropdown-item mb-1 @yield('global-setting-active')" href="{{ url('settings/global') }}">Global Settings</a>
              <a class="dropdown-item mb-1 @yield('notification-setting-active')" href="{{ url('settings/notification') }}">Notification</a>
              <a class="dropdown-item mb-1 @yield('mail-setting-active')" href="{{ url('settings/mail') }}">Mail</a>
            </div>
          </nav>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      @yield('setting-content')
    </div>
  </div>

</div>



@endsection

