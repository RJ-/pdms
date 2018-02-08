@extends('layouts.adminMaster')

@section('title')
  Faculty without Professional Development
@endsection

@section('content')
  @section('header')
    <b><a href="{{route('admin')}}"> </i> | Faculty without Professional Development for the last 12 months </a> </b>
  @endsection
      <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead class="thead">
                <tr>
                  <th>#</th>
                  <th>@sortablelink('surname', 'Name')</th>
                  <th>@sortablelink('college_id', 'College/Campus')</th>
                  <th>@sortablelink('academic_rank', 'Academic Rank')</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($faculties as $faculty)
                  <tr>
                    <th>{{$counter+=1}}</th>
                    <td><a href="{{route('showfaculty',$faculty->id)}}">{{$faculty->surname}}, {{$faculty->firstname}}</a></td>
                    <td>{{$faculty->college->name}}</td>
                    <td>{{$faculty->acadrank->name}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
            <center>{!! $faculties->appends(\Request::except('page'))->render() !!}</center>
      </div>
@endsection
