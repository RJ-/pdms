@extends('layouts.vpaa-activity')

@section('title')
    Edit Activity
@endsection

@section('stylesheets')
  <!-- Dashboard style -->
  <link href="{{ asset('css/multi-select.css') }}" rel="stylesheet" type="text/css" >

  <style media="screen">
    .tooltip-inner {
      background-color: #fff !important;
      /*!important is not necessary if you place custom.css at the end of your css calls. For the purpose of this demo, it seems to be required in SO snippet*/
      color: #000;
      text-align: left;
      max-width: 300px;
    }

    .tooltip.top .tooltip-arrow {
      border-top-color: #fff;
    }

    .tooltip.right .tooltip-arrow {
      border-right-color: #fff;
    }

    .tooltip.bottom .tooltip-arrow {
      border-bottom-color: #fff;
    }

    .tooltip.left .tooltip-arrow {
      border-left-color: #fff;
    }
  </style>
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
                          <span class="label label-primary">
                            {{$needs->name}}&nbsp</span>
                      @endif
                      @if ($activity->field != NULL)
                        @foreach ($activity->field as $field)
                          <span class="label label-primary">
                            {{$field->name}}&nbsp</span>
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
            <table class="table">
              <tr>
                <th class="block">Sponsor:</th>
                <td>{{$activity->sponsor}}</td>
              </tr>
              <tr>
                <th class="block">Where:</th>
                <td>{{$activity->venue}}</td>
              </tr>
              <tr>
                <th class="block"> When:</th>
                <td>
                  {{date('M j, Y', strtotime($activity -> dateFrom))}} - {{date('M j, Y', strtotime($activity -> dateTo))}}
                </td>
              </tr>
              <tr>
                <th class="block">Activity:</th>
                <td>{{ $pdcategory -> name}}</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card">
            <h6 class="card-header primary-color white-text">Your Confirmed Participant/s</h6>
              @if ($confirmed == NULL)
                <div class="row">
                  <div class="col-md-7" style="margin:10px;">
                    <em>No confirmed faculty.</em>
                  </div>
                </div>
              @endif
              <table class="table-responsive" style="margin-left: 12px;">
                  @foreach ($confirmed as $key => $confirmedfaculty)
                  <tbody>
                      <tr>
                        <td>
                        <a class="popper" data-toggle="popover" data-trigger="hover" style="margin-right: 25px;">
                            <b>
                            <i class="fa fa-user prefix"> </i> {{$confirmedfaculty->surname}}, {{$confirmedfaculty->firstname}}
                            </b>
                        </a>
                          <div class="popper-content" style="display: none;">
                            <div class="">
                              <b>{{$confirmedfaculty->college->name}}</b>
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
                              @foreach ($confirmedfaculty->field as $field)
                                <div class="tag tag-primary">
                                  {{$field->name}}
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </td>
                        <td>
                          {!! Form::model($activity, ['route' => ['removeVP', $activity->id],'method' => 'PUT'])!!}
                          <input type="hidden" name="faculty_id" value="{{$confirmedfaculty->id}}">
                          <button type="submit" name="button" class="btn btn-sm red"><i class="fa fa-times"></i> Remove</button>
                          {!! Form::close() !!}
                        </td>
                      </tr>
                  </tbody>
                @endforeach
              </table>
          </div>
          @if ($recommended != NULL)
          <div class="card">
            <h6 class="card-header primary-color white-text">Recommended Faculty by College Deans</h6>
                <table class="table-responsive" style="margin-left: 12px;">
                    @foreach ($recommended as $key => $reco)
                    {!! Form::model($activity, ['route' => ['recommend', $activity->id],'method' => 'PUT'])!!}
                    <tbody>
                        <tr>
                          <td>
                          <a class="popper" data-toggle="popover" data-trigger="hover" style="margin-right: 25px;">
                              <b>
                              <i class="fa fa-user prefix"> </i> {{$reco->surname}}, {{$reco->firstname}}
                              </b>
                          </a>
                            <div class="popper-content" style="display: none;">
                              <div class="">
                                <b>{{$reco->college->name}}</b>
                                <hr>
                                <b>Last Activity Attended:</b><br>
                                @if ($deanReco[$key] != NULL)
                                  <div class="text-primary">
                                    <b>{{$deanReco[$key]->title}}</b> <br>
                                    {{date('M j, Y', strtotime($deanReco[$key]->dateFrom))}} - {{date('M j, Y', strtotime($deanReco[$key]->dateTo))}}
                                  </div>
                                @else
                                  <em class="text-warning">The faculty has no PD intervention.</em>
                              @endif
                              <hr>
                              <em>Field of Specialization:</em><br>
                                @foreach ($reco->field as $field)
                                  <div class="tag tag-primary">
                                    {{$field->name}}
                                  </div>
                                @endforeach
                              </div>
                            </div>
                          </td>
                          <td>
                          {!! Form::model($activity, ['route' => ['removeVP', $activity->id],'method' => 'PUT'])!!}
                            <input type="hidden" name="faculty_id" value="{{$reco->id}}">
                            <button  name="button" class="btn btn-sm green"> <i class="fa fa-check"></i> Confirm</button>
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
                                          <input type="hidden" name="faculty_id" value="{{$reco->id}}">
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
                    </tbody>
                  @endforeach
                </table>
          </div>
          @endif
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
                  <h6 class="card-header view white-text">Faculty Recommendation</h6>
                  <div class="card-block">
                    <div class="row">
                      <div class="col-md-12" style="margin-left: 15px;">
                        <b>Faculty Response:</b>
                        <em class="text-success">Accepted </em>|
                        <em class="text-warning">Pending </em>|
                        <em class="text-danger"> Declined</em>
                      </div>
                    </div>
                    {!! Form::model($activity, ['route' => ['vpaa.update', $activity->id],
                      'method' => 'PUT'])!!}
                      <div class="md-form">
                        <select id='keep-order' multiple='multiple' name="faculty_id[]">
                          <optgroup label="List of Recommended Faculties">
                            @foreach ($employees as $key => $employees)
                              <option data-toggle="tooltip" data-html="true"
                               data-container="#tooltip_container" title="
                                 <b>{{$employees->college->name}}</b>
                                 <hr>
                                 <b>Last Activity Attended:</b><br>
                                 @if ($employeeReco[$key] != NULL)
                                   <div class='text-primary'>
                                     <b>{{$employeeReco[$key]->title}}</b> <br>
                                     {{date('M j, Y', strtotime($employeeReco[$key]->dateFrom))}} - {{date('M j, Y', strtotime($employeeReco[$key]->dateTo))}}
                                   </div>
                                 @else
                                   <em class='text-warning'>The faculty has no PD intervention.</em>
                               @endif
                               <hr>
                               <em>Field of Specialization:</em><br>
                                 @foreach ($employees->field as $field)
                                   <div class='tag tag-primary'>
                                     {{$field->name}}
                                   </div>
                                 @endforeach
                               "
                               @if ($faculty_response[$key] == 1)
                                 class="text-success" selected
                               @elseif ($faculty_response[$key] == 2)
                                 class="text-danger" disabled
                               @else
                                 class="text-warning"
                               @endif
                               value="{{$employees->id}}">{{$employees->surname}}, {{$employees->firstname}}</option>
                            @endforeach
                          </optgroup>
                        </select>
                        <div id="tooltip_container"></div>
                        <center>
                          <button class="btn green btn-md submit" type="submit">
                            <i class="fa fa-check left"></i>Recommend
                          </button>
                        </center>
                      </div>
                    {!! Form::close() !!}
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
  <script type="text/javascript">
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip({
            placement: 'left'});
    });
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

  <script type="text/javascript" src="{{ asset('js/jquery.multi-select.js') }}"></script>

  <script type="text/javascript">
  // run callbacks
        $('#keep-order').multiSelect({ keepOrder: true });
  </script>

@endsection
