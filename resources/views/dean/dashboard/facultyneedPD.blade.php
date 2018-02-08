@extends('layouts.dean-activity')

@section('title')
  Faculty without Professional Development
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
                  Faculty without Professional Development
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
                     | Without Professional Development for the last 12 months
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
                  <th>@sortablelink('academic_rank', 'Academic Rank')</th>
                  <th><a href="#">Field of Specialization</a> </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($faculties as $faculty)
                  <tr>
                    <th>{{$counter+=1}}</th>
                    <td><a href="{{route('viewProfile',$faculty->id)}}">{{$faculty->surname}}, {{$faculty->firstname}}</a></td>
                    <td>{{$faculty->acadrank->name}}</td>
                    <td> |
                      @foreach ($faculty->field as $field)
                        <span class="tag green">{{$field->name}}</span> |
                      @endforeach
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
            <center>{!! $faculties->appends(\Request::except('page'))->render() !!}</center>
      </div>
    </div>
  </div>
@endsection


@section('javascript')
  @include('footervarview')
@include('includes.dashboard')
@endsection
