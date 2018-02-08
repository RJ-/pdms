@extends('layouts.adminMaster')

@section('title')
Faculty Roster
@endsection

@section('content')
  @section('header')
    <span class="pull-right">
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
  </span> <br>
    <b><a href="{{route('admin')}}"> </i> | List of Faculty</a>  </b>

  @endsection

      <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead class="thead">
                <tr>
                  <th>#</th>
                  <th>@sortablelink('surname', 'Name')</th>
                  <th>@sortablelink('college_id', 'College')</th>
                  <th>@sortablelink('acadrank_id', 'Academic Rank')</th>
                  <th>Highest Academic Degree</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($faculties as $faculty)
                  <tr>
                    <th>{{$counter+=1}}</th>
                    <td><a href="{{route('showfaculty',$faculty->id)}}">{{$faculty->surname}}, {{$faculty->firstname}}</a></td>
                    <td>{{$faculty->college->name}}</td>
                    <td>{{$faculty->acadrank->name}}</td>
                    <td>
                      @foreach ($faculty->educbackground->reverse() as $e)
                        - {{$e->course}}<br>
                        @break
                      @endforeach
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <center>{!! $faculties->appends(\Request::except('page'))->render() !!}</center>
      </div>
@endsection
