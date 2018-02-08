@extends('layouts.vpaa-activity')

@section('title')
  Professional Development Activities
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
                  Professional Development Activities
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
          | List of Professional Development for the last 12 months
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
                  <th class="col-md-4">@sortablelink('title', 'Title')</th>
                  <th><a href="#">Sponsor</a></th>
                  <th>@sortablelink('dateFrom', 'Inclusive Dates')</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pdactivities as $pd)
                  <tr>
                    <th>{{$counter+=1}}</th>
                    <td><a href="{{route('viewActivityVpaa', $pd->id)}}">{{$pd->title}}</a></td>
                    <td>{{$pd->sponsor}}</td>
                    <td>{{date('M j, Y', strtotime($pd->dateFrom))}} - {{date('M j, Y', strtotime($pd->dateTo))}} </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <center>{!! $pdactivities->appends(\Request::except('page'))->render() !!}</center>
      </div>
    </div>
  </div>
@endsection


@section('javascript')
  @include('footervarview')
@include('includes.dashboard')
@endsection
