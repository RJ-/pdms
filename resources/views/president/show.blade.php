@extends('layouts.president-activity')

@section('title')
University President
@endsection

@section('content')
  <div class="view">
      <!--Intro content-->
      <div class="full-bg-img flex-center"><br>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="description">
                <h4 class="h4-responsive wow fadeIn">University President</h4>
                <hr class="hr-light responsive wow fadeIn">
                <h1 class="h1-responsive wow fadeIn">
                  Manage Professional Development Activities
                </h1>
              </div>
            </div>
          </div>
        </div><!--/.container-->
      </div>
  </div>
  <div class="wrapper">
    @include('includes.president-sidebar')
    <div id="content" class="container">
      <h2>
        <b>
        <div class="navbar-header">
                <a href="#" class="glyphicon glyphicon-align-justify btn-menu toggle"><i  id="sidebarCollapse"    class="fa fa-bars"></i></a>
          Manage Professional Development Activities
        </div>
      </b>
    </h2>
  <hr>
      <div class="row">
        <div class="col-md-12">
        <!--Panel-->
          <h6 class="card-header primary-color white-text">Professional Development Activities</h6>
          <?php $counter = 0 ?>
          @if ($activity == NULL)
            <div class="card">
              <div class="card-block">
                <h4 class="card-title" class="text-center">There are no Professional Development activities available.</h4>
              </div>
            </div>
          @else
            @foreach ($activity as $activity)
            <a href="{{route('president.edit', $activity->id)}}">
              <button type="button" class="btn green pull-right" style="margin: 12px;"name="button"> <i class="fa fa-eye"></i> View Activity</button>
            </a>
            <div class="card">
              <div class="card-block">
                <h4 class="card-title" class="text-center">
                  <a href="{{route('president.edit', $activity->id)}}">
                    <b>{{$activity->title}}</b>
                  </a>
                </h4>
                <hr>

                <div class="col-md-6">
                  <b>Details:</b>
                  <p class="card-text">
                    {{substr(strip_tags($activity->details), 0, 350)}}
                    <br>
                    <a href="{{route('president.edit', $activity->id)}}"><i>Read more...</i></a>
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
          @endif
        <!--/.Panel-->
      </div>
    </div>
  </div>
</div>
@endsection
