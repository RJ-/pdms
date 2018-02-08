@extends('layouts.president-activity')

@section('title')
  Notifications
@endsection

@section('content')
  <div class="view">
      <!--Intro content-->
      <div class="full-bg-img flex-center"><br>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="description">
                <h1 class="h1-responsive wow fadeIn"><i class="fa fa-gears"></i> Manage Notifications</h1>
                <hr class="hr-light responsive wow fadeIn">
              </div>
            </div>
          </div>
        </div><!--/.container-->
      </div>
  </div>

<div class="container">
<br>
  <div class="col-md-9">
    <div class="row">
          <div id="markasread" onclick="markNotificationAsRead('{{count(auth()->user()->unreadNotifications)}}')">
            @forelse (auth()->user()->unreadNotifications as $notification)
              @include('includes.notification.'.snake_case(class_basename($notification->type)))
              <hr>
            @empty
              <a class="text-primary">You have no new notifications</a>
            @endforelse
            <hr>
            <p><a href="#"><em>Earlier</em></a></p>
            @forelse (auth()->user()->readNotifications as $notification)
              @include('includes.notification.'.snake_case(class_basename($notification->type)))
              <hr>
            @empty
              <a class="text-black">You have no earlier notifications</a></small>
            @endforelse
          </div>
    </div>
  </div>
  {{-- <div class="col-md-3">
    <div class="card">
      <h5 class="card-header primary-color white-text">Quick Links</h3>
        <div class="list-group">
          <a href="#" class="list-group-item">Link 1</a>
          <a href="#" class="list-group-item">Link 2</a>
          <a href="#" class="list-group-item">Link 3</a>
        </div>
    </div>
  </div> --}}
</div>
@endsection
