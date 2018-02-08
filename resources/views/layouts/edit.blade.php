@extends('layouts.vpaa-activity')

@section('title')
    Edit Activity
@endsection

@section('stylesheets')

  <!-- Dashboard style -->
  <link href="{{ asset('css/multi-select.css') }}" rel="stylesheet" type="text/css" >

@endsection

@section('content')
<style media="screen">
.view {
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.flex-center {
    color: #fff;
    align-items:flex-end;
}
</style>
<div class="view">
    <!--Intro content-->
    <div class="full-bg-img flex-center"><br>
        <ul>
            <li>
                <h1 class="h1-responsive wow fadeInDown">{{$activity->title}}</h1>
            </li>
        </ul>
    </div>
</div>
    <div class="container">
      <br>
      <div class="row">
        <div class="col-md-7">
          <div class="card">
            <h4 class="card-header primary-color white-text">Description</h4>
            <div class="card-block">
              <p class="card-text">
                {!!$activity->details!!}
              </p>
              <p>
                <div class="row">
                  <div class="col-md-2">
                    <p class="pull-right"><i class="fa fa-map-marker prefix"></i> Tags:</p>
                  </div>
                  <div class="col-md-10">
                    <div class="tags">|
                      @foreach ($activity->field as $field)
                        <span class="label label-default">
                          <a href="#">{{$field->name}}</a> |</span>
                      @endforeach
                    </div>
                  </div>
                </div>
              </p>
            </div>
          </div>
          <div class="card">
            <h4 class="card-header primary-color white-text">Details</h4>
            <table class="table">
              <tr>
                <th>Where:</th>
                <td>{{$activity->venue}}</td>
              </tr>
              <tr>
                <th> When:</th>
                <td>
                  {{date('M j, Y', strtotime($activity -> dateFrom))}} - {{date('M j, Y', strtotime($activity -> dateTo))}}
                </td>
              </tr>
              <tr>
                <th>Participants:</th>
                <td><b>{{$activity->faculty->count()}}</b> faculty</td>
              </tr>
              <tr>
                <th>Type of Activity:</th>
                <td>{{ $pdcategory -> name}}</td>
              </tr>
              <tr>
                <th>Faculty Need Category:</th>
                <td>{{ $needs -> name}}</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card">
            <h6 class="card-header primary-color white-text">Your Confirmed Participant/s</h6>
            @foreach ($confirmed as $confirmed)
                {{-- {!! Form::model($activity, ['route' => ['recommend', $activity->id],'method' => 'PUT'])!!} --}}

                  <div class="row">
                    <div class="col-md-7" style="margin:10px;">
                    <i class="fa fa-user prefix"></i> <b>{{$confirmed->surname}}, {{$confirmed->firstname}}</b> -
                      <i>{{$confirmed->college->abbrv}}</i>
                    </div>
                    <div class="col-md-1" style="margin-top:2px;">
                        <input type="hidden" name="faculty_id" value="{{$confirmed->id}}">
                        <button type="submit" name="button" class="btn btn-sm btn-danger">Remove</button>
                    </div>
                  </div>
                  {!! Form::close() !!}
            @endforeach
          </div>
          <div class="card">
            <h6 class="card-header primary-color white-text">Recommended Participant/s</h6>
              @foreach ($faculty as $faculty)
                  {!! Form::model($activity, ['route' => ['recommend', $activity->id],'method' => 'PUT'])!!}

                    <div class="row">
                      <div class="col-md-7" style="margin:10px;">
                      <i class="fa fa-user prefix"></i> <b>{{$faculty->surname}}, {{$faculty->firstname}}</b> -
                        <i>{{$faculty->college->abbrv}}</i>
                      </div>
                      <div class="col-md-1" style="margin-top:2px;">
                          <input type="hidden" name="faculty_id" value="{{$faculty->id}}">
                          <button type="submit" name="button" class="btn btn-sm btn-primary">Confirm</button>
                      </div>
                    </div>
                    {!! Form::close() !!}
              @endforeach
                  <div class="row">
                    <center>
                    <button class="btn btn-warning btn-md" style="margin-bottom:20px; "data-toggle="modal" data-target="#EditModal" type="button">
                    <i class="fa fa-book left"></i>Edit List
                  </center>
                  </div>
          </div>
        </div>

        <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <!--Content-->
            <div class="modal-content">
              <div class="card">
                  <h6 class="card-header view white-text">Faculty Recommendation</h6>
                  <div class="card-block">
                    {!! Form::model($activity, ['route' => ['vpaa.update', $activity->id],
                      'method' => 'PUT'])!!}
                      <div class="md-form">
                        <select id='callbacks' multiple='multiple' name="faculty_id[]">
                          <optgroup label="Field of Specialization">
                            @foreach ($employees as $employees)
                              <option value="{{$employees->id}}">{{$employees->surname}}, {{$employees->firstname}}</option>
                            @endforeach
                          </optgroup>
                          <optgroup label="Faculty Needs">
                            @foreach ($f_needs as $f_needs)
                              @if ($f_needs->college_id==1)
                                <option value="{{$f_needs->id}}">{{$f_needs->surname}}, {{$f_needs->firstname}}</option>
                              @endif
                            @endforeach
                          </optgroup>
                          <optgroup label="Needs Training">
                            @foreach ($f_frequency as $f_frequency)
                              @if ($f_frequency->college_id==1)
                                <option value="{{$f_frequency->id}}">{{$f_frequency->surname}}, {{$f_frequency->firstname}}</option>
                              @endif
                            @endforeach
                          </optgroup>
                        </select>
                        <center>
                          <button class="btn btn-success btn-md submit" type="submit">
                            <i class="fa fa-book left"></i>Recommend
                          </button>
                          <a>
                          </a>
                        </center>
                      </div>
                    {!! Form::close() !!}
                    <h6 class="card-header primary-color white-text">Recommended Participant/s</h6>
                    @foreach ($recommended as $recommended)
                        {!! Form::model($activity, ['route' => ['recommend', $activity->id],'method' => 'PUT'])!!}

                          <div class="row">
                            <div class="col-md-7" style="margin:10px;">
                            <i class="fa fa-user prefix"></i> <b>{{$recommended->surname}}, {{$recommended->firstname}}</b> -
                              <i>{{$recommended->college->abbrv}}</i>
                            </div>
                            <div class="col-md-1" style="margin-top:2px;">
                                <input type="hidden" name="faculty_id" value="{{$recommended->id}}">
                                <button type="submit" name="button" class="btn btn-sm btn-danger">Remove</button>
                            </div>
                          </div>
                          {!! Form::close() !!}
                    @endforeach
                  </div>
              </div>
              <div class="card">

              </div>
          </div>
          <!--/.Content-->
        </div>
      </div>

      </div>
    </div>
  {{-- <div class="streak">
    <div class="flex-center">
      <ul>
        <li><h2 class="h2-responsive wow fadeIn">Hellow World</h2></li>
      </ul>
    </div>
  </div> --}}
@endsection

@section('javascript')
  <!-- JQuery -->
  <script type="text/javascript" src="{{ asset('js/jquery.multi-select.js') }}"></script>

  <script type="text/javascript">
  // run callbacks
        $('#callbacks').multiSelect({
        afterSelect: function(values){
          alert("Select value: "+values);
        },
        afterDeselect: function(values){
          alert("Deselect value: "+values);
        }
    });
  </script>

@endsection
