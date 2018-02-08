@extends('layouts.activity')

@section('title')
  Profile
@endsection

@section('stylesheets')
  <!-- Datepicker CSS -->
  <link href="{{ asset('datepicker/jquery.datetimepicker.css')}}" rel="stylesheet">

  <!-- Tags CSS -->
  <link href="{{ asset('css/select2.min.css')}}" rel="stylesheet">

@endsection

@section('content')
  <div class="view hm-blue-darken">
      <!--Intro content-->
      <div class="full-bg-img flex-center"><br>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="description">
                <h4 class="h4-responsive wow fadeIn">{{$faculty->college->name}}</h4>
                <hr class="hr-light responsive wow fadeIn">
                <h1 class="h1-responsive wow fadeIn">
                  <i class="fa fa-user prefix"></i>
                  {{$faculty-> firstname}} {{substr($faculty-> middlename, 0, 1)}}. {{$faculty-> surname}}
                </h1>
              </div>
            </div>
          </div>
        </div><!--/.container-->
      </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-block">
            <table class="table table-responsive">
              <tr>
                <th style="width:250px;"> <i class="fa fa-suitcase prefix"></i> Position:</th>
                <td>{{$faculty-> acadrank -> name}}</td>
              </tr>
              <tr>
                <th> <i class="fa fa-globe prefix"></i> Email:</th>
                <td>
                  @if ($faculty-> email == NULL)
                      <a class="btn btn-sm btn-success" href="{{route('faculty.edit', $faculty->id)}}">
                        <i class="fa fa-edit"></i> Add your email address</a>
                        </p>
                  @endif
                  {{$faculty-> email}}</td>
              </tr>
              <tr>
                <th><i class="fa fa-tag prefix"></i> Field of Specialization:</th>
                <td>
                  <div class="tags">|
                    @if ($faculty->field->count() == NULL)
                        <a class="btn btn-sm btn-success" href="{{route('faculty.edit', $faculty->id)}}">
                          <i class="fa fa-edit"></i> Add your Field of Specialization</a>
                          </p>
                          @else
                            @foreach ($faculty->field as $field)
                              <a href="#"><span class="label label-default">{{$field->name}}</span></a>  |
                            @endforeach
                            <a data-toggle="modal" data-target="#addOtherFields" style="cursor: pointer;" class="btn btn-success btn-sm">
                              <i class="fa fa-plus"></i>
                            </a>
                    @endif
                  </div>
                </td>
              </tr>
              <tr>
                <th><i class="fa fa-tag prefix"></i> Faculty Development Needs:</th>
                <td>
                  <div class="tags">|
                    @if ($faculty->needs->count() == NULL)
                        <a class="btn btn-sm btn-success" href="{{route('faculty.edit', $faculty->id)}}">
                          <i class="fa fa-edit"></i> Add your Faculty Development Needs</a>
                          </p>
                    @endif
                    @foreach ($faculty->needs as $needs)
                      <a href="#"><span class="label label-default">{{$needs->name}}</span></a>  |
                    @endforeach
                  </div>
                </td>
              </tr>

            </table>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs md-pills pills-ins flex-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#panel10" role="tab"><i class="fa fa-graduation-cap"></i> Education Background</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#panel11" role="tab"><i class="fa fa-users"></i> Seminars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#panel12" role="tab"><i class="fa fa-book"></i> Training and Workshops</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#panel13" role="tab"><i class="fa fa-flask"></i> Short Courses</a>
                </li>
            </ul>


            <!-- Tab panels -->
            <div class="tab-content">
                <!--Panel 0-->
                <div class="tab-pane fade in active" id="panel10" role="tabpanel">
                  <!--Panel-->
                  <div class="card">
                      <h6 class="card-header primary-color white-text">Educational Background</h6>
                      <div class="card-block">
                        @if ($educbackground->count() == NULL)
                          <div class="card-block">
                            <a class="btn btn-block btn-success" href="{{route('pdrecord', Auth::user()->id)}}">
                              <i class="fa fa-edit"></i> Add Educational Background Details</a>
                              </p>
                          </div>
                        @endif
                        @foreach ($educbackground as $educbackgrounds)
                          <div class="row">
                            <div class="col-md-12">
                              <span class="pull-right">
                                @if ($educbackgrounds->category->id == 1)
                                  <a href="#" data-toggle="modal" data-target="#bacc" style="cursor: pointer;">
                                @elseif ($educbackgrounds->category->id == 2)
                                  <a href="#" data-toggle="modal" data-target="#masteral" style="cursor: pointer;">
                                @elseif ($educbackgrounds->category->id == 3)
                                  <a href="#" data-toggle="modal" data-target="#doc" style="cursor: pointer;">
                                @endif
                                <i class="fa fa-edit"></i></a>
                              </span>
                              <h4 class="card-title text-primary"><b>{{$educbackgrounds->category->name}}</b>
                                | <i style="font-size: 18px;">{{$educbackgrounds-> yearstarted}} -
                                  @if($educbackgrounds->yeargraduated != NULL)
                                    {{$educbackgrounds-> yeargraduated}}
                                  @else
                                    {{"on-going"}}
                                  @endif
                                </i>
                              </h4>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-md-6"><i class="fa fa-graduation-cap prefix"></i>
                                <b>Course: </b>{{$educbackgrounds-> course}}</div>
                          </div>
                          <hr>
                          @if ($educbackgrounds-> major != NULL)
                            <div class="row">
                              <div class="col-md-6"><i class="fa fa-flask prefix"></i>
                               <b>Major: </b>{{$educbackgrounds-> major}}</div>
                            </div>
                            <hr>
                          @endif
                          <div class="row">
                              <div class="col-md-6"><i class="fa fa-university prefix"></i>
                                <b>School:</b> {{$educbackgrounds-> school}}</div>
                          </div>
                          <hr>
                          @if ($educbackgrounds-> scholarship != NULL)
                            <div class="row">
                              <div class="col-md-6"><i class="fa fa-book prefix"></i>
                                <b>Scholarship:</b> {{$educbackgrounds-> scholarship}}</div>
                            </div>
                            <hr>
                          @endif
                          @if ($educbackgrounds-> award != NULL)
                            <div class="row">
                                <div class="col-md-6"><i class="fa fa-flask prefix"></i>
                                  <b>Award: </b>{{$educbackgrounds-> award}}</div>
                            </div>
                            <hr>
                          @endif
                        @endforeach
                      </div>
                  </div>
                  <!--/.Panel-->
                </div>
                <!--/.Panel 0-->

                <!--Panel 1-->
                <div class="tab-pane fade" id="panel11" role="tabpanel">
                  <!--Panel-->
                  <div class="card">
                      <h6 class="card-header primary-color white-text">Seminars Attended</h6>
                      <div class="card-block">
                        @if ($seminars == NULL)
                          <div class="card-block">
                            <a class="btn btn-block btn-success" href="{{route('pdrecord', Auth::user()->id)}}">
                              <i class="fa fa-edit"></i> Add Seminars Attended</a>
                              </p>
                          </div>
                        @endif
                        @php
                          $counter = 0;
                        @endphp
                        @foreach ($seminars as $key => $seminar)
                          <div class="row">
                            <div class="col-md-12">
                          @if ($seminar->createdBy > 0 && $seminar->activity_status < 2)
                            <span class="pull-right">
                              <a href="#" data-toggle="modal" data-target="#seminar-{{$seminar->id}}" style="cursor: pointer;">
                              <i class="fa fa-edit"></i></a>
                            </span>
                            <i class="fa fa-warning"></i><em class="text-warning"> Approval Pending (Submit neccessary documents to the HRD Office)</em>
                          @endif
                          @if ($seminar->createdBy == 0 && $seminar_status[$counter] != 3 && $seminar->activity_status < 2)
                            <i class="fa fa-warning"></i><em class="text-warning"> Approval Pending (Submit neccessary documents to the HRD Office)</em>
                            <button class="btn btn-warning pull-right" type="button" name="button" data-toggle="modal" data-target="#submit-{{$seminar->id}}" style="cursor: pointer;">
                              <i class="fa fa-paper-plane"></i> Submit Certificate
                            </button>
                          @endif
                              <h4 class="card-title">
                                <b>
                                <a href="{{route('activity', $seminar->id)}}" class="text-primary">{{$seminar->title}}</a>
                                </b>
                              </h4>
                              {!!$seminar-> details!!}
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-md-6"><i class="fa fa-map prefix"></i>
                                <b>Venue: </b>{{$seminar-> venue}}</div>

                              <div class="col-md-6"><i class="fa fa-users prefix"></i>
                               <b>Sponsor: </b>{{$seminar-> sponsor}}</div>
                            </div>
                            <hr>
                          <div class="row">
                              <div class="col-md-6"><i class="fa fa-calendar prefix"></i>
                                <b>Inclusive Dates:</b>
                                {{date('F j, Y', strtotime($seminar -> dateFrom))}} - {{date('F j, Y', strtotime($seminar -> dateTo))}}
                              </div>
                          </div>
                          <hr>
                        @endforeach
                      </div>
                  </div>
                  <!--/.Panel-->
                </div>
                <!--/.Panel 1-->

                <!--Panel 2-->
                <div class="tab-pane fade" id="panel12" role="tabpanel">
                  <!--Panel-->
                  <div class="card">
                      <h6 class="card-header primary-color white-text">Training/Workshop Attended</h6>
                      <div class="card-block">
                        @if ($trainings == NULL)
                          <div class="card-block">
                            <a class="btn btn-block btn-success" href="{{route('pdrecord', Auth::user()->id)}}">
                              <i class="fa fa-edit"></i> Add Trainings/Workshops Attended</a>
                              </p>
                          </div>
                        @endif
                        @php
                          $counter = 0;
                        @endphp
                        @foreach ($trainings as $key => $training)
                          <div class="row">
                            <div class="col-md-12">
                          @if ($training->createdBy > 0 && $training->activity_status < 2)
                            <span class="pull-right">
                              <a href="#" data-toggle="modal" data-target="#training-{{$training->id}}" style="cursor: pointer;">
                              <i class="fa fa-edit"></i></a>
                            </span>
                            <i class="fa fa-warning"></i><em class="text-warning"> Approval Pending (Submit neccessary documents to the HRD Office)</em>
                          @endif
                          @if ($training->createdBy == 0 && $training_status[$counter] != 3 && $training->activity_status < 2)
                            <i class="fa fa-warning"></i><em class="text-warning"> Approval Pending (Submit neccessary documents to the HRD Office)</em>
                            <button class="btn btn-warning pull-right" type="button" name="button" data-toggle="modal" data-target="#submit-{{$training->id}}" style="cursor: pointer;">
                              <i class="fa fa-paper-plane"></i> Submit Certificate
                            </button>
                          @endif
                              <h4 class="card-title">
                                <b>
                                <a href="{{route('activity', $training->id)}}" class="text-primary">{{$training->title}}</a>
                                </b>
                              </h4>
                              {!!$training-> details!!}
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-md-6"><i class="fa fa-map prefix"></i>
                                <b>Venue: </b>{{$training-> venue}}</div>

                              <div class="col-md-6"><i class="fa fa-users prefix"></i>
                               <b>Sponsor: </b>{{$training-> sponsor}}</div>
                            </div>
                            <hr>
                          <div class="row">
                              <div class="col-md-6"><i class="fa fa-calendar prefix"></i>
                                <b>Inclusive Dates:</b>
                                {{date('F j, Y', strtotime($training -> dateFrom))}} - {{date('F j, Y', strtotime($training -> dateTo))}}
                              </div>
                          </div>
                          <hr>
                        @endforeach
                      </div>
                  </div>
                  <!--/.Panel-->
                </div>
                <!--/.Panel 2-->

                <!--Panel 3-->
                <div class="tab-pane fade" id="panel13" role="tabpanel">
                  <!--Panel-->
                  <div class="card">
                      <h6 class="card-header primary-color white-text">Short Courses Attended</h6>
                      <div class="card-block">
                        @if ($courses == NULL)
                          <div class="card-block">
                              <a class="btn btn-block btn-success" href="{{route('pdrecord', Auth::user()->id)}}">
                                <i class="fa fa-edit"></i> Add Short Courses Attended</a>
                              </p>
                          </div>
                        @endif
                        @php
                          $counter = 0;
                        @endphp
                        @foreach ($courses as $key => $course)
                          <div class="row">
                            <div class="col-md-12">
                          @if ($course->createdBy > 0 && $course->activity_status < 2)
                            <span class="pull-right">
                              <a href="#" data-toggle="modal" data-target="#shortcourse-{{$course->id}}" style="cursor: pointer;">
                              <i class="fa fa-edit"></i></a>
                            </span>
                            <i class="fa fa-warning"></i><em class="text-warning"> Approval Pending (Submit neccessary documents to the HRD Office)</em>
                          @endif
                          @if ($course->createdBy == 0 && $course_status[$counter] != 3 && $course->activity_status < 2)
                            <i class="fa fa-warning"></i><em class="text-warning"> Approval Pending (Submit neccessary documents to the HRD Office)</em>
                            <button class="btn btn-warning pull-right" type="button" name="button" data-toggle="modal" data-target="#submit-{{$course->id}}" style="cursor: pointer;">
                              <i class="fa fa-paper-plane"></i> Submit Certificate
                            </button>
                          @endif
                              <h4 class="card-title">
                                <b>
                                <a href="{{route('activity', $course->id)}}" class="text-primary">{{$course->title}}</a>
                                </b>
                              </h4>
                              {!!$course-> details!!}
                            </div>
                          </div>
                              <hr>
                              <div class="row">
                                  <div class="col-md-6"><i class="fa fa-map prefix"></i>
                                    <b>Venue: </b>{{$course-> venue}}</div>

                                  <div class="col-md-6"><i class="fa fa-users prefix"></i>
                                   <b>Sponsor: </b>{{$course-> sponsor}}</div>
                                </div>
                                <hr>
                              <div class="row">
                                  <div class="col-md-6"><i class="fa fa-calendar prefix"></i>
                                    <b>Inclusive Dates:</b>
                                    {{date('F j, Y', strtotime($course -> dateFrom))}} - {{date('F j, Y', strtotime($course -> dateTo))}}
                                  </div>
                              </div>
                              <hr>
                        @endforeach
                      </div>
                  </div>
                  <!--/.Panel-->
                </div>
                <!--/.Panel 3-->
                @include('faculty.pages.include.edit-educ-degree-modal')
                @include('faculty.pages.include.edit-pd-info-modal')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
  <script type="text/javascript">
  $('#popoverData').popover({html:true});
  </script>

  <!-- Datepicker JavaScript -->
  <script src="{{asset('datepicker/jquery.datetimepicker.full.js')}}"></script>
  <script type="text/javascript">
  $('#datepickerFrom').datetimepicker({
    i18n:{
     en:{
      months:[
       'January','February','March','April',
       'May','June','July','August',
       'September','October','November','December',
      ],
      dayOfWeek:[
       "Su.", "Mon", "Tue", "Wed",
       "Thurs", "Fri", "Sat.",
      ]
     }
    },
    timepicker:false,
    format:'d.m.Y'
  });
  $('#datepickerTo').datetimepicker({
    i18n:{
     en:{
      months:[
       'January','February','March','April',
       'May','June','July','August',
       'September','October','November','December',
      ],
      dayOfWeek:[
       "Su.", "Mon", "Tue", "Wed",
       "Thurs", "Fri", "Sat.",
      ]
     }
    },
    timepicker:false,
    format:'d.m.Y'
  });
  $('#datepickerFromS').datetimepicker({
    i18n:{
     en:{
      months:[
       'January','February','March','April',
       'May','June','July','August',
       'September','October','November','December',
      ],
      dayOfWeek:[
       "Su.", "Mon", "Tue", "Wed",
       "Thurs", "Fri", "Sat.",
      ]
     }
    },
    timepicker:false,
    format:'d.m.Y'
  });
  $('#datepickerToS').datetimepicker({
    i18n:{
     en:{
      months:[
       'January','February','March','April',
       'May','June','July','August',
       'September','October','November','December',
      ],
      dayOfWeek:[
       "Su.", "Mon", "Tue", "Wed",
       "Thurs", "Fri", "Sat.",
      ]
     }
    },
    timepicker:false,
    format:'d.m.Y'
  });
  $('#datepickerFromSh').datetimepicker({
    i18n:{
     en:{
      months:[
       'January','February','March','April',
       'May','June','July','August',
       'September','October','November','December',
      ],
      dayOfWeek:[
       "Su.", "Mon", "Tue", "Wed",
       "Thurs", "Fri", "Sat.",
      ]
     }
    },
    timepicker:false,
    format:'d.m.Y'
  });
  $('#datepickerToSh').datetimepicker({
    i18n:{
     en:{
      months:[
       'January','February','March','April',
       'May','June','July','August',
       'September','October','November','December',
      ],
      dayOfWeek:[
       "Su.", "Mon", "Tue", "Wed",
       "Thurs", "Fri", "Sat.",
      ]
     }
    },
    timepicker:false,
    format:'d.m.Y'
  });
  $('#datepickerFromR').datetimepicker({
    i18n:{
     en:{
      months:[
       'January','February','March','April',
       'May','June','July','August',
       'September','October','November','December',
      ],
      dayOfWeek:[
       "Su.", "Mon", "Tue", "Wed",
       "Thurs", "Fri", "Sat.",
      ]
     }
    },
    timepicker:false,
    format:'d.m.Y'
  });
  $('#datepickerToR').datetimepicker({
    i18n:{
     en:{
      months:[
       'January','February','March','April',
       'May','June','July','August',
       'September','October','November','December',
      ],
      dayOfWeek:[
       "Su.", "Mon", "Tue", "Wed",
       "Thurs", "Fri", "Sat.",
      ]
     }
    },
    timepicker:false,
    format:'d.m.Y'
  });
  $('#datepickerFromE').datetimepicker({
    i18n:{
     en:{
      months:[
       'January','February','March','April',
       'May','June','July','August',
       'September','October','November','December',
      ],
      dayOfWeek:[
       "Su.", "Mon", "Tue", "Wed",
       "Thurs", "Fri", "Sat.",
      ]
     }
    },
    timepicker:false,
    format:'d.m.Y'
  });
  $('#datepickerToE').datetimepicker({
    i18n:{
     en:{
      months:[
       'January','February','March','April',
       'May','June','July','August',
       'September','October','November','December',
      ],
      dayOfWeek:[
       "Su.", "Mon", "Tue", "Wed",
       "Thurs", "Fri", "Sat.",
      ]
     }
    },
    timepicker:false,
    format:'d.m.Y'
  });
  </script>

  <script type="text/javascript">
      $(document).on("click", ".success", function(e) {
        if (confirm("Are you sure you want to submit field?")) {
        }else{
          e.preventDefault();
        }

      });
  </script>


@endsection
