@extends('layouts.activity')
@section('title')
  Home
@endsection

@section('stylesheets')
  <link href="{{ asset('css/home-style.css') }}" rel="stylesheet" type="text/css" >
  <style media="screen">
  #sidebar {
      min-width: 250px;
      max-width: 250px;
      color: #000;
      transition: all 0.3s;
      margin-left: 0px;
  }

  #sidebar.active {
      margin-left: -250px;
  }

  </style>
@endsection

@section('content')
<div class="view">
    <!--Intro content-->
    <div class="full-bg-img flex-center"><br>
        <ul>
            <li>
                <h1 class="h1-responsive wow fadeInDown">PARSU | Professional Development Management System</h1>
            </li>
        </ul>
    </div>
</div>
<div class="wrapper">
  @include('includes.home-sidebar')
  <div id="content" class="container">
    <h4>
      <b>
      <div class="navbar-header">
              <a href="#" class="glyphicon glyphicon-align-justify btn-menu toggle"><i  id="sidebarCollapse"    class="fa fa-bars"></i></a>
        Development Feed
      </div>
    </b>
  </h4>
<hr>
    <br>
    <div class="row">
        @if ($activities == NULL)
          <div class="card">
            <div class="card-block">
              <h4>There are no Professional Development Activities available as of this moment.</h4>
            </div>
          </div>
        @endif
        @foreach ($activities as $key => $activity)
        <div class="col-md-10">
            <div class="card">
              <div class="card-block">
                <div class="col-md-8" style="border-right:1px solid #000;height:100%;margin-right:10px;">
                  <h4 class="card-title" style="margin-top:0px;">
                    <b><a href="{{route('activity', $activity->id)}}">{{$activity->title}}</a></b></h4>
                    <p class="card-text" style="font-size: 14px;">
                    {{substr(strip_tags($activity->details), 0, 350)}}
                    <a href="{{route('activity', $activity->id)}}">Read more...</a>
                  </p>
                </div>
                <div class="small">
                  <b>Sponsor:</b> {{$activity->sponsor}} <br>
                  <b>Where:</b> {{$activity->venue}} <br>
                  <b>When:</b>  {{date('F j, Y', strtotime($activity -> dateFrom))}} - {{date('F j, Y', strtotime($activity -> dateTo))}}
                </div>
                @if ($activity->field->count() != NULL)
                  <div class="tags small"><i class="fa fa-tag prefix"></i> Tags:
                      @foreach ($activity->field as $field)
                        <a href="#"><span class="label label-warning">{{$field->name}}</span></a>
                      @endforeach
                  </div>
              </div>
              <div class="card-footer card-warning"></div>
                @else
                  <div class="small"><i class="fa fa-tag prefix"></i> Tags:
                        <a href="#"><span class="label label-primary">{{$fneeds[$key]}}</span></a>
                  </div>
              </div>
              <div class="card-footer card-primary"></div>
                @endif
        </div>
          </div>
        @endforeach
    </div>
  </div>
  <center>{{ $activities->links() }}</center>
</div>
@endsection
