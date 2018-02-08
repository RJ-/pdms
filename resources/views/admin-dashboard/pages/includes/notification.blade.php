@extends('layouts.adminMaster')

@section('title')
  Notifications
@endsection

@section('content')
  @section('header')
          <b> Manage Notifications </b>
  @endsection
<div class="row">
  <div class="col-md-11">
    <div class="row">
          <div id="markasread" onclick="markNotificationAsRead('{{count(auth()->user()->unreadNotifications)}}')">
            @forelse (auth()->user()->unreadNotifications as $notification)
              @include('includes.notification.'.snake_case(class_basename($notification->type)))
              <hr>
            @empty
              <a class="text-primary">You have no new notifications</a>
            @endforelse
            <hr>

            @forelse (auth()->user()->readNotifications as $notification)
              @include('includes.notification.'.snake_case(class_basename($notification->type)))
              <hr>
            @empty
              <a class="text-black">You have no earlier notifications</a></small>
            @endforelse
          </div>
    </div>
  </div>
</div>
@endsection
