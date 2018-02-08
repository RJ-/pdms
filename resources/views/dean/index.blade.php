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
                  {{$faculty-> firstname}} {{substr($faculty-> middlename, 0,1)}}. {{$faculty-> surname}}
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
        @include('dean.dashboard.layout-dashboard')
    </div>
  </div>
</div><!--/.container 1-->
</div> <!--/.wrapper 1-->
@endsection

@section('javascript')
  @include('footervarview')
  @include('includes.dashboard')
@endsection
