@extends('layouts.adminMaster')

@section('title')
  College/Campus | {{$college->name}}
@endsection

@section('content')
  @section('header')
  <div class="row">
      <div class="col-md-12">
        <div class="col-md-9">
          <b><a href="{{route('campus-college.index')}}">{{$college->name}}</a> | </b>
          <small>{{$faculty->count()}} Faculty</small>
        </div>
        <div class="col-md-3">
          <a href="{{route('campus-college.edit',$college->id)}}" class="btn btn-info pull-right btn-md">
            <i class="fa fa-edit"></i> Edit College/Campus</a>
        </div>
      </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-9">
        @if ($deans == NULL)
          <div class="col-md-4">
              <a href="{{route('campus-college.edit',$college->id)}}" class="btn green pull-left btn-block">
              <i class="fa fa-user-plus"></i>  Assign College/Campus Dean
              </a>
          </div>
        @else
          <small><b>Dean : </b>{{$deans->firstname}} {{$deans->surname}}</small>
        @endif
      </div>
    </div>
  </div>
  @endsection

  <div class="row">
    <div class="col-md-8">
      @if ($faculty->count() == NULL)
        {{"No faculty was listed on this college."}}
      @else
      <div class="row">
        <div class="col-md-1">
          #
        </div>
        <div class="col-md-4">
          Name
        </div>
        <div class="col-md-4">
          Academic Rank
        </div>
      </div>

      @foreach ($faculty as $faculty)
      <div class="row">
          <hr>
          <div class="col-md-1">
            {{$counter++}}
          </div>
          <div class="col-md-4">
            <a href="{{route('showfaculty', $faculty->id)}}">{{$faculty -> firstname}} {{$faculty -> surname}}</a>
          </div>
          <div class="col-md-4">
            {{$faculty->acadrank->name}}
          </div>
          <div class="col-md-3">
            <a href="{{route('showfaculty', $faculty->id)}}" class="btn blue btn-block"><i class="fa fa-eye"></i> View Profile</a>
          </div>

      </div>
      @endforeach
    </div>
    @endif
  </div>
@endsection
