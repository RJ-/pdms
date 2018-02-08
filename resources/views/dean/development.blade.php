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
          Dashboard
        </div>
      </b>
    </h2>
  <hr>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-block">
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">68%</div>
                                    <div>Faculty PD Attendees</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">17</div>
                                    <div>Faculty Scholars</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">124</div>
                                    <div>Faculty in Graduate Studies</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!--Panel-->
              <div class="col-md-12">
                <table class="table">
                  <thead class="thead">
                    <tr>
                      <th>#</th>
                      <th>@sortablelink('surname', 'Name')</th>
                      <th>Course</th>
                      <th>@sortablelink('academic_id', 'Academic Rank')</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($faculties as $faculty)
                      <tr>
                        <th>{{$counter+=1}}</th>
                        <td>{{$faculty->surname}}, {{$faculty->firstname}}</td>
                        <td>{{$faculty->college->name}}</td>
                        <td>{{$faculty->acadrank->name}}</td>
                        <td><a href="{{route('showfaculty', $faculty->id)}}" class="btn btn-info btn-block">View Profile</a></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <center>{!! $faculties->appends(\Request::except('page'))->render() !!}</center>

            <!--/.Panel-->
        </div>
      </div>
    </div>
  </div>
</div><!--/.container 1-->
</div> <!--/.wrapper 1-->
@endsection
