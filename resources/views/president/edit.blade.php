@extends('layouts.president-activity')

@section('title')
    Recommend Faculty
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
                <h1 class="h1-responsive wow fadeIn">{{$activity->title}}</h1>
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
                    <div class="tags">
                      @if ($needs != NULL)
                          <span class="label label-warning">
                          {{$needs->name}}</span>
                      @endif

                      @if ($activity->field != NULL)
                        @foreach ($activity->field as $field)
                          <span class="label label-primary">
                            {{$field->name}} </span>&nbsp
                        @endforeach
                      @endif
                    </div>
                  </div>
                </div>
              </p>
            </div>
          </div>
          <div class="card">
            <h4 class="card-header primary-color white-text">Details</h4>
            <table class="table table-responsive">
              <tr>
                <th class="block">Sponsor:</th>
                <td>{{$activity->sponsor}}</td>
              </tr>
              <tr>
                <th class="col-md-3">Where:</th>
                <td>{{$activity->venue}}</td>
              </tr>
              <tr>
                <th> When:</th>
                <td>
                  {{date('M j, Y', strtotime($activity -> dateFrom))}} - {{date('M j, Y', strtotime($activity -> dateTo))}}
                </td>
              </tr>
              <tr>
                <th>Type of Activity:</th>
                <td>{{ $pdcategory -> name}}</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-5">
          @if ($faculty != NULL)
          <div class="card">
              <h6 class="card-header primary-color white-text">Recommended Participant/s by the VPAA</h6>
              <table class="table-responsive" style="margin-left: 12px;">
                @foreach ($faculty as $key => $faculty)
                  <tbody>
                      <tr>
                        <td>
                          <a class="popper" data-toggle="popover" data-trigger="hover" style="margin-right: 25px;">
                              <b>
                              <i class="fa fa-user prefix"> </i> {{$faculty->surname}}, {{$faculty->firstname}}
                              </b>
                          </a>
                          <div class="popper-content" style="display: none;">
                            <div class="">
                              <b>{{$faculty->college->name}}</b>
                              <hr>
                              <b>Last Activity Attended:</b><br>
                              @if ($pdVpaa[$key] != NULL)
                                <div class="text-primary">
                                  <b>{{$pdVpaa[$key]->title}}</b> <br>
                                  {{date('M j, Y', strtotime($pdVpaa[$key]->dateFrom))}} - {{date('M j, Y', strtotime($pdVpaa[$key]->dateTo))}}
                                </div>
                              @else
                                <em class="text-warning">The faculty has no PD intervention.</em>
                              @endif
                            <hr>
                            <em>Field of Specialization:</em><br>
                            @foreach ($faculty->field as $field)
                              <div class="tag tag-primary">
                                {{$field->name}}
                              </div>
                            @endforeach
                        </td>
                        <td>
                        {!! Form::model($activity, ['route' => ['updateStatus', $activity->id],'method' => 'PUT']) !!}
                          <input type="hidden" name="faculty_id" value="{{$faculty->id}}">
                          <button type="submit" name="button" class="btn btn-sm green approve"><i class="fa fa-check"></i> Approve </button>
                          <a data-toggle="modal" data-target="#notifyFaculty" style="cursor: pointer;" class="btn btn-warning btn-sm">
                            <i class="fa fa-envelope"></i>
                          </a>
                        {!! Form::close() !!}
                        <div class="modal fade" id="notifyFaculty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <!--Content-->
                            <div class="modal-content">
                              {!! Form::model( $activity->id, ['route' => ['adminNotifyFaculty', $activity->id], 'method' => 'put']) !!}
                                <div class="card-block">
                                  {{-- header --}}
                                  <div class="text-xs-center">
                                    <h3><i class="fa fa-book"></i> Notify Faculty</h3>
                                    <hr class="mt-2 mb-2">
                                  </div>
                                  {{-- body --}}
                                  <div class="md-form">
                                    <input type="text" name="message" value="" required>
                                  </div>
                                  <hr>
                                    <div class="md-form">
                                      <input type="hidden" name="_token" value="{{Session::token()}}">
                                      <input type="hidden" name="faculty_id" value="{{$faculty->id}}">
                                      <input type="hidden" name="p_dactivity_id" value="{{ $activity->id}}">
                                      <button class="btn green pull-right" type="submit" name="button" value="submit"><i class="fa fa-floppy-o"></i> Submit</button>
                                      <button class="btn red pull-right" type="cancel" data-dismiss="modal" value="Cancel" > <i class="fa fa-times"></i> Cancel</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                              </div>
                            <!--/.Content-->
                            </div>
                        </div>
                        </td>
                      </tr>
                @endforeach
                  </tbody>
              </table>
          </div>
          @endif

          <div class="card">
            <h6 class="card-header primary-color white-text">Your Approved Participant/s</h6>
            @if ($confirmed == NULL)
              <p style="margin: 20px;">
                <em>No approved participant/s.</em>
              </p>
            @endif
            <table class="table-responsive" style="margin-left: 12px;">
                @foreach ($confirmed as $key => $faculty)
                <tbody>
                    <tr>
                      <td>
                      <a class="popper" data-toggle="popover" data-trigger="hover" style="margin-right: 25px;">
                          <b>
                          <i class="fa fa-user prefix"> </i> {{$faculty->surname}}, {{$faculty->firstname}}
                          </b>
                      </a>
                        <div class="popper-content" style="display: none;">
                          <div class="">
                            <b>{{$faculty->college->name}}</b>
                            <hr>
                            <b>Last Activity Attended:</b><br>
                            @if ($pdConfirmed[$key] != NULL)
                              <div class="text-primary">
                                <b>{{$pdConfirmed[$key]->title}}</b> <br>
                                {{date('M j, Y', strtotime($pdConfirmed[$key]->dateFrom))}} - {{date('M j, Y', strtotime($pdConfirmed[$key]->dateTo))}}
                              </div>
                            @else
                              <em class="text-warning">The faculty has no PD intervention.</em>
                          @endif
                          <hr>
                          <em>Field of Specialization:</em><br>
                            @foreach ($faculty->field as $field)
                              <div class="tag tag-primary">
                                {{$field->name}}
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </td>
                      <td>
                      {!! Form::model($activity, ['route' => ['removePres', $activity->id],'method' => 'PUT'])!!}
                        <input type="hidden" name="faculty_id" value="{{$faculty->id}}">
                        <button type="submit" name="button" class="btn btn-sm red danger">
                          <i class="fa fa-times"></i> Remove</button>
                      {!! Form::close() !!}
                      </td>
                    </tr>
              @endforeach
                </tbody>
            </table>
          </div>
          <div class="row">
            <center>
            <button class="btn btn-info btn-md" style="margin-bottom:20px; "data-toggle="modal" data-target="#EditModal" type="button">
            <i class="fa fa-book left"></i>Manage List
          </center>
          </div>
        </div>

        <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <!--Content-->
            <div class="modal-content">
              <div class="card">
                  <h6 class="card-header view white-text">Other Recommended Faculty</h6>
                  <div class="card-block">
                        @if ($employees == NULL)
                          <em>No other faculty suggestions.</em>
                        @else
                          <table class="table-responsive" style="margin-left: 12px;">
                              @foreach ($employees as $key => $faculty)
                              <tbody>
                                  <tr>
                                    <td>
                                    <a class="popper" data-toggle="popover" data-trigger="hover" style="margin-right: 25px;">
                                        <b>
                                        <i class="fa fa-user prefix"> </i> {{$faculty->surname}}, {{$faculty->firstname}}
                                        </b>
                                    </a>
                                      <div class="popper-content" style="display: none;">
                                        <div class="">
                                          <b>{{$faculty->college->name}}</b>
                                          <hr>
                                          <b>Last Activity Attended:</b><br>
                                          @if ($pdEmployee[$key] != NULL)
                                            <div class="text-primary">
                                              <b>{{$pdEmployee[$key]->title}}</b> <br>
                                              {{date('M j, Y', strtotime($pdEmployee[$key]->dateFrom))}} - {{date('M j, Y', strtotime($pdEmployee[$key]->dateTo))}}
                                            </div>
                                          @else
                                            <em class="text-warning">The faculty has no PD intervention.</em>
                                        @endif
                                        <hr>
                                        <em>Field of Specialization:</em><br>
                                          @foreach ($faculty->field as $field)
                                            <div class="tag tag-primary">
                                              {{$field->name}}
                                            </div>
                                          @endforeach
                                        </div>
                                      </div>
                                    </td>
                                    <td>
                                      {!! Form::model($activity, ['route' => ['updateStatus', $activity->id],'method' => 'PUT'])!!}
                                      <input type="hidden" name="faculty_id" value="{{$faculty->id}}">
                                      <button type="submit" name="button" class="btn btn-sm green approve"><i class="fa fa-check"></i> Approve</button>
                                      {!! Form::close() !!}
                                    </td>
                                  </tr>
                            @endforeach
                              </tbody>
                          </table>
                        @endif
                  </div>
              </div>
          </div>
          <!--/.Content-->
        </div>
      </div>
    </div>
      <hr>
      @if ($confirmed != NULL)
        <div class="row">
          <center>
            <div class="wow fadeInUp" data-wow-delay="0.4s">
                {!! Form::model($activity, ['route' => ['approveActivity', $activity->id],'method' => 'PUT'])!!}
                    <input type="hidden" name="p_dactivity_id" value="{{$activity->id}}">
                    <button class="btn btn-success btn-lg" type="submit" name="button">
                      <i class="fa fa-check left"></i>Finalize Activity
                    </button>
                {!! Form::close() !!}
            </div>
          </center>
        </div>
      @endif
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
  $('[data-toggle="popover"]').popover({html:true});
  </script>

  <script type="text/javascript">
  $('.popper').popover({
      placement: 'left',
      container: 'body',
      html: true,
      content: function () {
          return $(this).next('.popper-content').html();
      }
  });
  </script>

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
