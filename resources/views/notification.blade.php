@extends('layouts.master')
@section('title','Notifications')
@section('notifications-active','active')

@section('content')

<div class="card shadow-sm p-3 mb-5 bg-white rounded">
    <div class="card-header">
        Firebase Push Notification
    </div>
    <div class="card-body">
      <form action="{{ url('send-notification') }}" method="post" name="sendNotification" id="sendNotification">
        @csrf
        <h5 class="card-title mb-3">Target News</h5>
        <select class="form-select" aria-label="Default select example" name="news" >
          <option selected value="">Select Target News</option>
          @if (count($news) > 0)
          @foreach ($news as $n)
          <option  value="{{ $n }}">{{ $n->title }}</option>
          @endforeach
          @endif
        </select>
        
        <div id="newsHelp" class="form-text">
          select target news
         </div>
        
        <h5 class="card-title mt-4">Notification Title</h5>
        
        <div class="mb-4 mt-3">
          <input type="text" class="form-control" id="notificationBody" name="notificationBody">
          <div id="notificationHelp" class="form-text">
             insert notification body
            </div>
        </div>
        
        
        
        <div class="text-end">
          <a href="javascript: sendNotification()" class="btn btn-primary ">Send Notificattion</a>
        </div>
      </form>
     
     
    </div>
  </div>
@endsection