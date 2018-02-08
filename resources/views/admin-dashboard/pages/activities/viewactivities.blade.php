@extends('layouts.adminMaster')

@section('title')
  Faculty Development
@endsection

@section('content')
  @section('header')
    <b>List of Professional Development Activities</b>

  @endsection

    <div class="row">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs md-pills pills-ins flex-center" role="tablist">
          <li class="nav-item active">
              <a class="nav-link" data-toggle="tab" href="#panel10" role="tab"> 2018</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#panel11" role="tab"> 2017</a>
          </li>
      </ul>

      <!-- Tab panels -->
      <div class="tab-content">
          <!--Panel 0-->
          <div class="tab-pane fade in active" id="panel10" role="tabpanel">
            <!--Panel-->
            <div class="row">
                <div class="col-md-12">
                  @if ($thisyear->count() == NULL)
                      <h2>No registered activity yet.</h2>
                      <a href="{{route('pdactivity.create')}}"> <button class="btn btn-primary" type="button" name="button">Add activity</button></a>
                    @else
                      @php
                        $counter = 1;
                      @endphp
                  <table class="table">
                    <thead class="thead">
                      <tr>
                        <th>#</th>
                        <th class="col-md-4">@sortablelink('title')</th>
                        <th class="col-md-4">Details</th>
                        <th class="col-md-2">@sortablelink('createdBy', 'Created By')</th>
                        <th class="col-md-2"></th>
                      </tr>
                    </thead>
                    <tbody>
                          @foreach ($thisyear as $activity)
                            <tr>
                              <th>{{$counter++}}</th>
                              <td><a href="{{route('pdactivity.show', $activity->id)}}">{{$activity->title}}</a></td>
                              <td>{{substr(strip_tags($activity->details), 0, 50)}} {{strlen(strip_tags($activity->details)) > 50 ? "..." : ""}}</td>
                              <td>
                                @if ($activity->createdBy == 0)
                                  {{"Human Resoruce Director"}}
                                @else
                                  {{$activity->createdfac->surname}}, {{$activity->createdfac->firstname}}
                                @endif
                              </td>
                              <td><a href="{{route('pdactivity.show', $activity->id)}}" class="btn blue btn-sm">
                                <i class="fa fa-eye"></i> View</a>
                              </a> <a href="{{route('pdactivity.edit', $activity->id)}}" class="btn btn-default btn-sm">
                                <i class="fa fa-edit"></i> Edit</a></td>
                            </tr>
                          @endforeach
                      @endif

                    </tbody>
                  </table>
                  <center>
                    @if ($thisyear->count() != NULL)
                      {!! $thisyear->appends(\Request::except('page'))->render() !!}
                    @endif
                  </center>
                </div>
            </div>
              <!--/.Panel-->
          </div>
          <!--/.Panel-->

          <!--Panel 0-->
          <div class="tab-pane fade in" id="panel11" role="tabpanel">
            <!--Panel-->
            <div class="row">
                <div class="col-md-12">
                  @if ($lastyear->count() == NULL)
                      <h2>No registered activity yet.</h2>
                      <a href="{{route('pdactivity.create')}}"> <button class="btn btn-primary" type="button" name="button">Add activity</button></a>
                    @else
                      @php
                        $counter = 1;
                      @endphp
                  <table class="table">
                    <thead class="thead">
                      <tr>
                        <th>#</th>
                        <th class="col-md-4">@sortablelink('title')</th>
                        <th class="col-md-4">Details</th>
                        <th class="col-md-2">@sortablelink('createdBy', 'Created By')</th>
                        <th class="col-md-2"></th>
                      </tr>
                    </thead>
                    <tbody>
                          @foreach ($lastyear as $activity)
                            <tr>
                              <th>{{$counter++}}</th>
                              <td><a href="{{route('pdactivity.show', $activity->id)}}">{{$activity->title}}</a></td>
                              <td>{{substr(strip_tags($activity->details), 0, 50)}} {{strlen(strip_tags($activity->details)) > 50 ? "..." : ""}}</td>
                              <td>
                                @if ($activity->createdBy == 0)
                                  {{"Human Resoruce Director"}}
                                @else
                                  {{$activity->createdfac->surname}}, {{$activity->createdfac->firstname}}
                                @endif
                              </td>
                              <td><a href="{{route('pdactivity.show', $activity->id)}}" class="btn blue btn-sm">
                                <i class="fa fa-eye"></i> View</a>
                              </a> <a href="{{route('pdactivity.edit', $activity->id)}}" class="btn btn-default btn-sm">
                                <i class="fa fa-edit"></i> Edit</a></td>
                            </tr>
                          @endforeach
                      @endif

                    </tbody>
                  </table>
                  <center>
                    @if ($lastyear->count() != NULL)
                      {!! $lastyear->appends(\Request::except('page'))->render() !!}
                    @endif
                  </center>
                </div>
            </div>
              <!--/.Panel-->
          </div>
          <!--/.Panel-->

      </div>
  </div>
@endsection
