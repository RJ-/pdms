@extends('layouts.adminMaster')

@section('title')
  Faculty Development
@endsection

@section('content')
  @section('header')
    <a href="{{'viewfaculty'}}"><b>Faculty Roster</b></a>
  @endsection
  <form action="/search" method="POST" role="search">
    {{ csrf_field() }}
    <div class="input-group">
        <input type="text" class="form-control" name="q"
            placeholder="Search faculty"> <span class="input-group-btn">
            <button type="submit" class="btn btn-success btn-lg">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
</form>
<div class="row">
  <div class="container">
    @if(isset($details))
        <p> The Search results for your query <b> {{ $query }} </b> are :</p>
    <h2>Sample User details</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
</div>
    <div class="row">
      <br>
        <table class="table">
          <thead class="thead-inverse">
            <tr>
              <th>#</th>
              <th>@sortablelink('surname', 'Name')</th>
              <th>@sortablelink('college_id', 'College/Campus')</th>
              <th>@sortablelink('acadrank_id', 'Academic Rank')</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($faculty as $faculties)
              <tr>
                <th>{{$counter++}}</th>
                <td><a href="{{route('showfaculty', $faculties->id)}}">{{$faculties->surname}}, {{$faculties->firstname}} {{$faculties->middlename}}</a></td>
                <td><a href="{{route('campus-college.show', $faculties->college->id)}}">{{$faculties->college->name}}</a></td>
                <td>{{$faculties->acadrank->name}}</td>
                <td><a href="{{route('showfaculty', $faculties->id)}}" class="btn btn-info btn-block">
                  <i class="fa fa-eye"></i> View Profile</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
    </div>
    @if ($faculty != NULL)
      {!! $faculty->appends(\Request::except('page'))->render() !!}
    @endif
@endsection
