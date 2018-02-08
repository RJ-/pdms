@extends('layouts.adminMaster')

@section('title')
  Professional Development Activities
@endsection

@section('content')
  @section('header')
    <b><a href="{{route('admin')}}"> </i>| List of Professional Development for the last 12 months </a>  </b>
  @endsection
      <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead class="thead">
                <tr>
                  <th >#</th>
                  <th class="col-md-6">@sortablelink('title', 'Title')</th>
                  <th class="col-md-3">Sponsor</th>
                  <th class="col-md-3">@sortablelink('dateFrom', 'Inclusive Dates')</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pdactivities as $pd)
                  <tr>
                    <th>{{$counter+=1}}</a></th>
                    <td><a href="{{route('pdactivity.show',$pd->id)}}">{{$pd->title}}</td>
                    <td>{{$pd->sponsor}}</td>
                    <td>{{date('M j, Y', strtotime($pd->dateFrom))}} - {{date('M j, Y', strtotime($pd->dateTo))}} </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <center>{!! $pdactivities->appends(\Request::except('page'))->render() !!}</center>
      </div>
@endsection
