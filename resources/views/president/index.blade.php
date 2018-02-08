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
                  {{Auth::user()->firstname}} {{substr(Auth::user()->middlename, 0, 1)}}. {{Auth::user()->surname}}, PhD
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
          Dashboard
        </div>
      </b>
    </h2>
    <hr>
      <div class="row">
        <div class="col-md-12">

          @include('president.dashboard.layout-dashboard')

          <div class="col-md-6">
            <canvas id="pd" width="100" height="100"></canvas>
          </div>
          <div class="col-md-6">
            <canvas id="faculty" width="100" height="100"></canvas>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection


@section('javascript')
  @include('footervarview')
  @include('includes.dashboard')
@endsection
