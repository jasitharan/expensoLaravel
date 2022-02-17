@extends('settings.settings')
@section('notification-setting-active','active')



@section('setting-content')

<div class="card shadow-sm p-3 mb-5 bg-white rounded">
    <div class="card-header">
      Firebase Push Notification Settings
  </div>
  <form action="{{ url('settings/notification') }}" method="post" name="setting-notification-form">
    <input name="_method" type="hidden" value="patch">
    @csrf
    <div class="card-body">

   
      <h5 class="card-title mt-4">Firebase Cloud Messaging Key</h5>
      
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="fcm_key" name="fcm_key" value="{{ $settings->fcm_key }}">
        <div id="fcm_keyHelp" class="form-text">
          Insert Firebase Cloud Messaging Key <a href="https://console.firebase.google.com">( https://console.firebase.google.com/ )</a>
          </div>
      </div>
      
      <div class="text-end">
        <a href="javascript: saveSettingNotification()" class="btn btn-primary ">Save</a>
      </div>
     
    </div>
  </form>
 
  </div>


@endsection

