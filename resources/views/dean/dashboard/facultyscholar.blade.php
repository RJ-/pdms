@extends('layouts.dean-activity')

@section('title')
Faculty Scholars
@endsection

@section('content')
  <div class="view">
      <!--Intro content-->
      <div class="full-bg-img flex-center"><br>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="description">
                <h4 class="h4-responsive wow fadeIn">Dean, {{Auth::user()->college->name}}</h4>
                <hr class="hr-light responsive wow fadeIn">
                <h1 class="h1-responsive wow fadeIn">
                  Faculty Scholars
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
                     | List of Faculty Scholars
        </div>
      </b>
    </h2>
  <hr>
      <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead class="thead">
                <tr>
                  <th>#</th>
                  <th>@sortablelink('surname', 'Name')</th>
                  <th>Scholarship</th>
                  <th>University</th>
                  <th>Course</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($faculties as $key => $faculty)
                  <tr>
                    <th>{{$counter+=1}}</th>
                    <td><a href="{{route('viewProfile',$faculty->id)}}">{{$faculty->surname}}, {{$faculty->firstname}}</a></td>
                      <td>{{$scholarship[$key]->scholarship}}</td>
                      <td>{{$scholarship[$key]->school}}</td>
                      <td>{{$scholarship[$key]->course}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
@endsection


@section('javascript')
  @include('footervarview')
@include('includes.dashboard')
@endsection
