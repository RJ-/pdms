@extends('layouts.dean-activity')

@section('title')
    Recommend Faculty
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
              <h6 class="card-header view white-text">Edit List of Recommended Faculty</h6>
              <div class="card-block">
                <div class="row">
                  <div class="col-md-12" style="margin-left: 15px;">
                    <b>Faculty Response:</b>
                    <em class="text-success">Accepted </em>|
                    <em class="text-warning">Pending </em>|
                    <em class="text-danger"> Declined</em>
                  </div>
                </div>
                {!! Form::model($activity, ['route' => ['dean.update', $activity->id],
                  'method' => 'PUT'])!!}
                  <div class="md-form">
                    <select id='keep-order' multiple='multiple' name="faculty_id[]">
                      <optgroup label="List of Recommended Faculties">
                        @foreach ($employees as $key => $employees)
                          @if ($employees->college_id==Auth::user()->college_id)
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
                             value="{{$employees->id}}">{{$employees->surname}}, {{$employees->firstname}}
                           </option>
                          @endif
                        @endforeach
                      </optgroup>
                    </select>
                    <div id="tooltip_container"></div>
                    <div class="col-md-12">
                      <center>
                        <button class="btn green btn-md submit" type="submit">
                          <i class="fa fa-check left"></i>Recommend
                        </button>
                      </center>
                    </div>
                  </div>
                  {!! Form::close() !!}
                  </div>
          </div>
        </div>
        <div class="col-md-5">
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
                <th>Activity type:</th>
                <td>{{ $pdcategory -> name}}</td>
              </tr>
              <tr>
                <th>Tags:</th>
                <td class="small">
                  <div class="tags">
                    @if ($needs != NULL)
                        <span class="label label-primary">
                          {{$needs->name}} </span>&nbsp
                    @endif
                    @if ($activity->field != NULL)
                      @foreach ($activity->field as $field)
                        <span class="label label-primary">
                          {{$field->name}}</span>&nbsp
                      @endforeach
                    @endif
                  </div>
                </td>
              </tr>
              <tr>
                <th colspan="3">Details:</th>
              </tr>
              <tr>
                <td colspan="2">{!!$activity->details!!}</td>
              </tr>
            </table>
          </div>
          <div class="card">
            <h6 class="card-header primary-color white-text">Recommended Faculty by College Deans</h6>
            @if ($confirmed == NULL)
              <div class="row">
                <div class="col-md-7" style="margin:10px;">
                  <em>No recommended faculty.</em>
                </div>
              </div>
            @endif
            <table class="table-responsive" style="margin: 12px;">
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
                        {!! Form::model($activity, ['route' => ['remove', $activity->id],'method' => 'PUT'])!!}
                        @if ($confirmedfaculty->college_id == Auth::user()->college_id)
                              <input type="hidden" name="faculty_id" value="{{$confirmedfaculty->id}}">
                              <button type="submit" name="button" class="btn btn-sm red"><i class="fa fa-times"></i> Remove</button>
                        @endif
                        {!! Form::close() !!}
                      </td>
                    </tr>
                </tbody>
              @endforeach
            </table>
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
  <script type="text/javascript">
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip({
            placement: 'right'});
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

  <!-- JQuery -->
  <script type="text/javascript" src="{{ asset('js/jquery.multi-select.js') }}"></script>

  <script type="text/javascript">
  // run callbacks
  $('#keep-order').multiSelect({ keepOrder: true });

  </script>

@endsection
