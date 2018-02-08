@extends('layouts.vpaa-activity')

@section('title')
Vice-President for Academic Affairs
@endsection

@section('content')
  <div class="view">
      <!--Intro content-->
      <div class="full-bg-img flex-center"><br>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="description">
                <h4 class="h4-responsive wow fadeIn">Vice-President for Academic Affairs</h4>
                <hr class="hr-light responsive wow fadeIn">
                <h1 class="h1-responsive wow fadeIn">
                  {{$college->name}}
                </h1>
              </div>
            </div>
          </div>
        </div><!--/.container-->
      </div>
  </div>
  <div class="wrapper">
    @include('includes.vpaa-sidebar')
    <div id="content" class="container">
      <h2>
        <b>
        <div class="navbar-header">
                <a href="#" class="glyphicon glyphicon-align-justify btn-menu toggle"><i  id="sidebarCollapse"    class="fa fa-bars"></i></a>
                <a href="{{route('vpaa.index')}}"> </i> Dashboard</a>
                          | Manage Professional Development Activities
        </div>
      </b>
    </h2>
  <hr>
  <div class="row">
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-users fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{$numfaculty}}</div>
                          <div>Number of Faculty</div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-green">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-university fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{$gradstudents}}</div>
                          <div>Graduate Student</div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-yellow">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-graduation-cap fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{$mas}}</div>
                          <div>{{$ms}}% Masteral Degree</div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-red">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-graduation-cap fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{$doc}}</div>
                          <div>{{$phd}}% Doctorate Degree</div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- /.panel row -->
      <div class="row">
      <div class="col-md-12">
        <!--Panel-->
            <h6 class="card-header primary-color white-text">Professional Development Activities</h6>
            <?php $counter = 0 ?>
            @if ($activities == NULL)
              <div class="card">
                <div class="card-block">
                  <h4 class="card-title" class="text-center">There are no Professional Development activities available.</h4>
                </div>
              </div>
            @else
              @foreach ($activities as $activity)
              <a href="{{route('vpaa.edit', $activity->id)}}">
                <button type="button" class="btn green pull-right" style="margin: 12px;"name="button"> <i class="fa fa-check-square-o"></i> Recommend/Approve</button>
              </a>
              <div class="card">
                <div class="card-block">
                  <h4 class="card-title" class="text-center">
                    <a href="{{route('vpaa.edit', $activity->id)}}" class="text-primary">
                      <b>{{$activity->title}}</b>
                    </a>
                  </h4>

                  <hr>

                  <div class="col-md-6">
                    <b>Details:</b>
                    <p class="card-text">
                      {{substr(strip_tags($activity->details), 0, 350)}}
                      <br>
                      <a href="{{route('vpaa.edit', $activity->id)}}"><i>Read more...</i></a>
                    </p>
                  </div>
                  <div class="col-md-4">
                    <div class="row">
                      <b># of Recommended Faculty:</b>
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
        </div>
        <!--/.Panel-->
    </div>
  </div>
</div><!--/.wrapper-->
@endsection
