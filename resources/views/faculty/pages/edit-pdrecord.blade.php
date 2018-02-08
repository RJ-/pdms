@extends('layouts.activity')

@section('title')
  Manage Profile
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
              <h1 class="h1-responsive wow fadeIn"><i class="fa fa-cogs"></i> Manage Professional Development Record</h2>
              <hr class="hr-light responsive wow fadeIn">
            </div>
          </div>
        </div>
      </div><!--/.container-->
    </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
    @include('faculty.pages.include.educ-degree-modal')
    @include('faculty.pages.include.pd-info-modal')
<div class="card">
  <div class="card-block">
    <div class="col-lg-12">
      <div class="row">
          <div class="col-md-4">
            <h2><b>Your Educational Background</b></h2>
            <p>Manage information regarding your
              educational background your baccallaureate degree,
              masteral and doctoral degree.</p>

              <i class="fa fa-info"></i><em class="text-primary"> Submit evidences of
              your educational attainment at the Human Resource
              Development Office for approval.</em>
          </div>
          <div class="col-md-8">
            <div class="card">
              <div class="card-block" data-toggle="modal" data-target="#bacc" style="cursor: pointer;">
                <div class="col-lg-4">
                    <b>Baccallaureate Degree</b>
                </div>
                <div class="col-lg-6">
                  <p class="text-muted">Add baccallaureate degree information</p>
                </div>
                <div class="pull-right">
                  <i class="fa fa-angle-right prefix"></i>
                </div>
              </div>
            <hr>
              <div class="card-block" data-toggle="modal" data-target="#masteral" style="cursor: pointer;">
                <div class="col-lg-4">
                    <b>Masteral Degree</b>
                </div>
                <div class="col-lg-6">
                  <p class="text-muted">Add masteral degree information</p>
                </div>
                <div class="pull-right">
                  <i class="fa fa-angle-right prefix"></i>
                </div>
              </div>
            <hr>
              <div class="card-block" data-toggle="modal" data-target="#doc" style="cursor: pointer;">
                <div class="col-lg-4">
                    <b>Doctoral Degree</b>
                </div>
                <div class="col-lg-6">
                  <p class="text-muted">Add doctoral degree information</p>
                </div>
                <div class="pull-right">
                  <i class="fa fa-angle-right prefix"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="card">
  <div class="card-block">
    <div class="col-lg-12">
      <div class="row">
          <div class="col-md-4">
            <h2><b>Your Professional Development Record</b></h2>
            <p>Manage your trainings, workshop and seminar
              attended as well as your research and extension
              activities in the university. </p>

              <i class="fa fa-info"></i><em class="text-primary"> Submit evidences of
              your educational attainment at the Human Resource
              Development Office for approval</em>.
          </div>
          <div class="col-md-8">
            <div class="card">
              <div class="card-block" data-toggle="modal" data-target="#seminar" style="cursor: pointer;">
                <div class="col-lg-4">
                    <b>Seminars and Conferences</b>
                </div>
                <div class="col-lg-6">
                  <p class="text-muted">Add information about your seminars and conferences attended</p>
                </div>
                <div class="pull-right">
                  <i class="fa fa-angle-right prefix"></i>
                </div>
              </div>
            <hr>
              <div class="card-block" data-toggle="modal" data-target="#training" style="cursor: pointer;">
                <div class="col-lg-4">
                    <b>Trainings and Workshops</b>
                </div>
                <div class="col-lg-6">
                  <p class="text-muted">Add information about your trainings and workshops attended</p>
                </div>
                <div class="pull-right">
                  <i class="fa fa-angle-right prefix"></i>
                </div>
              </div>
            <hr>
              <div class="card-block" data-toggle="modal" data-target="#shortcourse" style="cursor: pointer;">
                <div class="col-lg-4">
                    <b>Short Course</b>
                </div>
                <div class="col-lg-6">
                  <p class="text-muted">Add information about your short course projects</p>
                </div>
                <div class="pull-right">
                  <i class="fa fa-angle-right prefix"></i>
                </div>
              </div>
            <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    </div>
  </div>
</div>
@endsection

@section('javascript')
  <!-- Tags JavaScript -->
  <script src="{{asset('js/select2.min.js')}}"></script>

  <!-- Datepicker JavaScript -->
  <script src="{{asset('datepicker/jquery.datetimepicker.full.js')}}"></script>
  <script type="text/javascript">
  $('#birthdate').datetimepicker({
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
      $(document).on("click", ".cancel", function(e) {
          if(confirm("Are you sure you want to cancel update?")){

          }else{
            e.preventDefault();
          }
      });
      $(document).on("click", ".submit", function(e) {
              if(confirm("Confirm and Save Data?"){

              }else{
                e.preventDefault();
              }
      });
  </script>
@endsection
