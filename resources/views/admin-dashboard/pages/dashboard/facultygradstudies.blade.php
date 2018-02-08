@extends('layouts.adminMaster')

@section('title')
Faculty in Graduate Studies
@endsection

@section('content')
  @section('header')
    <b><a href="{{route('admin')}}"> | List of Faculty in Graduate Studies </a></b>
  @endsection
      <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead class="thead">
                <tr>
                  <th>#</th>
                  <th>@sortablelink('surname', 'Name')</th>
                  <th>@sortablelink('college_id', 'College')</th>
                  <th>School</th>
                  <th>Course</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($faculties as $key => $faculty)
                  <tr>
                    <th>{{$counter+=1}}</th>
                    <td><a href="{{route('showfaculty',$faculty->id)}}">{{$faculty->surname}}, {{$faculty->firstname}}</a></td>
                    <td>{{$faculty->college->abbrv}}</td>
                    <td>{{$gradStudies[$key]->school}}</td>
                    <td>{{$gradStudies[$key]->course}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
@endsection
