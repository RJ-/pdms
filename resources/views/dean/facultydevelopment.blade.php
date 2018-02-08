@extends('layouts.dean-activity')

@section('title')
  Faculty Development
@endsection

@section('content')
  <div class="view">
      <!--Intro content-->
      <div class="full-bg-img flex-center"><br>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="description">
                <h4 class="h4-responsive wow fadeIn"><b>{{$collegename->name}}</b></h4>
                <hr class="hr-light responsive wow fadeIn">
                <h1 class="h1-responsive wow fadeIn">
                  <i class="fa fa-user prefix"></i>
                  Faculty Development
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
          <div class="navbar-header">
                  <a href="#" class="glyphicon glyphicon-align-justify btn-menu toggle"><i  id="sidebarCollapse"    class="fa fa-bars"></i></a>
                  <a href="{{route('dean.index')}}"> </i> Dashboard</a> | Faculty Development
            </div>
      </b>
    </h2>
  <hr>
    <!-- /. header row -->
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
          @if ($faculties == NULL)
              <h2>No registered faculty yet.</h2>

            @else
          <table class="table">
            <thead class="thead">
              <tr>
                <th>#</th>
                <th>@sortablelink('surname', 'Name')</th>
                <th>@sortablelink('acadrank_id', 'Academic Rank')</th>
                <th>@sortablelink('educ_category_id', 'Highest Educational Attainment')</th>
                <th><a href="#">Graduate Studies</a></th>
              </tr>
            </thead>
            <tbody>
                  @foreach ($faculties as $faculty)
                    <tr>
                      <th>{{$counter+=1}}</th>
                      <td><a href="{{route('viewProfile', $faculty->id)}}">{{$faculty->surname}}, {{$faculty->firstname}}</a></td>
                      <td>{{$faculty->acadrank->name}}</td>
                      <td>
                        @if ($faculty->educbackground->count() != 0)
                          @foreach ($faculty->educbackground->reverse() as $e)
                            @if ($e->yeargraduated != NULL)
                              {{$e->course}}
                              @break
                            @endif
                          @endforeach
                          @else
                          -
                        @endif
                      </td>
                      <td>
                        @if ($faculty->educbackground->count() != 0)
                          @foreach ($faculty->educbackground->reverse() as $e)
                            @if ($e->yeargraduated == NULL)
                              {{$e->course}}
                              @if ($e->scholarship != NULL)
                                <span class="label label-success">({{$e->scholarship}})</span>
                              @endif
                            @endif
                          @endforeach
                        @else
                          -
                        @endif
                      </td>
                    </tr>
                  @endforeach
              @endif

            </tbody>
          </table>
        </div>
        <center>
          @if ($faculties != NULL)
            {!! $faculties->appends(\Request::except('page'))->render() !!}
          @endif
        </center>
    </div>
  </div><!--/.container 1-->
</div> <!--/.wrapper 1-->
@endsection
