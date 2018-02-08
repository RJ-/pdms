@extends('layouts.president-activity')

@section('title')
Faculty in Graduate Studies
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
                  Faculty in Graduate Studies
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

           <a href="{{route('president.index')}}"> </i> Dashboard</a>
                     | List of Faculty in Graduate Studies
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
                  <th><a href="#">Name</a> </th>
                  <th><a href="#">College</a> </th>
                  <th><a href="#">School</th>
                  <th><a href="#">Course</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($faculties as $key => $faculty)
                  <tr>
                    <th>{{$counter+=1}}</th>
                    <td><a href="{{route('viewProfilePres', $faculty->id)}}">{{$faculty->surname}}, {{$faculty->firstname}}</a></td>
                    <td>{{$faculty->college->abbrv}}</td>
                    <td>{{$gradStudies[$key]->school}}</td>
                    <td>{{$gradStudies[$key]->course}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
@endsection
