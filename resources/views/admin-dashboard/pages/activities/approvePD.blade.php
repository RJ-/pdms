@extends('layouts.adminMaster')

@section('title')
  Submitted Applications
@endsection

@section('content')
  @section('header')
    <b>Activities for Approval</b>
  @endsection
    <div class="row">
      <br>
      @if ($activities != NULL)
        <table class="table">
          <thead class="thead-inverse">
            <tr>
              <th>#</th>
              <th class="col-md-3">Title</th>
              <th class="col-md-3">Details</th>
              <th class="col-md-3">Created by</th>
              <th class="col-md-3">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($activities as $activity)
              <tr>
                <th>{{$counter++}}</th>
                <td><a href="{{route('approvePdActivity', $activity->id)}}">{{$activity->title}}</a></td>
                <td><i>{{substr(strip_tags($activity->details), 0, 50)}} {{strlen(strip_tags($activity->details)) > 50 ? "..." : ""}}</td></i>
                <td>
                  @if ($activity->createdBy == 0)
                    {{"Human Resource Director"}}
                  @else
                    {{$activity->createdfac->surname}}, {{$activity->createdfac->firstname}}
                  @endif
                </td>
                <td>
                  <a href="{{route('approvePdActivity', $activity->id)}}">
                    <button class="btn btn-sm   btn-info" type="button" name="button"><i class="fa fa-eye"></i> View Details</button>
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <h3>No applications available.</h3>
      @endif
    </div>
@endsection
