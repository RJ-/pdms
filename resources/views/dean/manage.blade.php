@extends('layouts.dean-activity')

@section('title')
  Profile
@endsection

@section('content')
  <div class="view">
      <!--Intro content-->
      <div class="full-bg-img flex-center"><br>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="description">
                <h4 class="h4-responsive wow fadeIn">Dean, {{$faculty->college->name}}</h4>
                <hr class="hr-light responsive wow fadeIn">
                <h1 class="h1-responsive wow fadeIn">
                  <i class="fa fa-user prefix"></i>
                  {{$faculty-> firstname}} {{$faculty-> middlename}} {{$faculty-> surname}}
                </h1>
              </div>
            </div>
          </div>
        </div><!--/.container-->
      </div>
  </div>
  <div class="wrapper">
    @include('includes.dean-sidebar')
    <div id="content" class="container">
      <h2>
        <b>
          <div class="navbar-header">
                  <a href="#" class="glyphicon glyphicon-align-justify btn-menu toggle"><i  id="sidebarCollapse"    class="fa fa-bars"></i></a>
                  <a href="{{route('dean.index')}}"> </i> Dashboard</a>
              | Manage Development Activities
        </div>
      </b>
    </h2>
  <hr>
    <div class="row">
      <div class="col-md-12">
        <h6 class="card-header primary-color white-text">Professional Development Activities</h6>
        <?php $counter = 0 ?>
        @if ($activities == NULL)
          <div class="card">
            <div class="card-block">
              <h4 class="card-title" class="text-center">There are no Professional Development activities available.</h4>
            </div>
          </div>
        @endif
        @foreach ($activities as $activity)
        <a href="{{route('dean.show', $activity->id)}}">
          <button type="button" class="btn green pull-right" style="margin: 12px;"name="button">
            <i class="fa fa-user"></i> Recommend Faculty</button>
        </a>
        <div class="card">
          <div class="card-block">
            <h4 class="card-title" class="text-center">
              <a href="{{route('dean.show', $activity->id)}}" class="text-primary">
                <b>{{$activity->title}}</b>
              </a>
            </h4>

            <hr>

            <div class="col-md-6">
              <b>Details:</b>
              <p class="card-text">
                {{substr(strip_tags($activity->details), 0, 350)}}
                <br>
                <a href="{{route('dean.show', $activity->id)}}"><i>Read more...</i></a>
              </p>
            </div>
            <div class="col-md-4">
              <div class="row">
                <b>Recommended Faculty:</b>
                  @if ($faculty[$counter]==0)
                    None
                  @else
                    {{$faculty[$counter]}}
                  @endif
                  <?php $counter++ ?>
              </div>
              <div class="row">
                <b>Date:</b>
                {{date('M j, Y', strtotime($activity -> dateFrom))}} - {{date('M j, Y', strtotime($activity -> dateTo))}}
              </div>
              <div class="row">
                <b>Venue:</b>
                {{$activity->venue}}
              </div>
            </div>
          </div>
          <div class="card-footer card-primary"></div>
        </div>
        <br>
        @endforeach
      </div>
  </div>
</div><!--/.container 1-->
</div> <!--/.wrapper 1-->
@endsection
