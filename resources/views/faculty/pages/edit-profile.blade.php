@extends('layouts.activity')

@section('title')
  Manage Profile
@endsection

@section('stylesheets')
  <!-- Datepicker CSS -->
  <link href="{{ asset('datepicker/jquery.datetimepicker.css')}}" rel="stylesheet">

  <!-- Tags CSS -->
  <link href="{{ asset('css/select2.min.css')}}" rel="stylesheet">

  {!! Html::style('css/parsley.css') !!}


@endsection

@section('content')
  <div class="view hm-blue-darken">
      <!--Intro content-->
      <div class="full-bg-img flex-center"><br>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="description">
                <h1 class="h1-responsive wow fadeIn"><i class="fa fa-cogs"></i> Manage your Profile</h1>
                <hr class="hr-light responsive wow fadeIn">
              </div>
            </div>
          </div>
        </div><!--/.container-->
      </div>
  </div>
  @include('faculty.pages.edit-profile-modal')
  <div class="container">
    <div class="card">
      <div class="card-block">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-md-5">
              <h2><i class="fa fa-user"></i> Your Profile Settings</h2>
              <p>Manage your profile details here.</p>
            </div>
            <div class="col-md-7">
              <div class="card">
                <div class="card-block" data-toggle="modal" data-target="#profile" style="cursor: pointer;">
                  <div class="col-lg-4">
                      <b>Manage Profile</b>
                  </div>
                  <div class="col-lg-6">
                    <p class="text-muted">Change your profile details such as username, email address, etc.</p>
                  </div>
                  <div class="pull-right">
                    <i class="fa fa-angle-right prefix"></i>
                  </div>
                </div>
              <hr>
              </div>
            </div>
          </div>
          <hr>
            <div class="row">
              <div class="col-md-5">
                <h2><i class="fa fa-wrench"></i> Your Security Settings</h2>
                <p>Manage/Reset your password here.</p>
                  <i class="fa fa-info"></i><em class="text-primary"> Last Updated: {{date('F j, Y - h:i a', strtotime(Auth::user()->updated_at))}}</em>
              </div>
              <div class="col-md-7">
                <div class="card">
                  <div class="card-block" data-toggle="modal" data-target="#password" style="cursor: pointer;">
                    <div class="col-lg-4">
                        <b>Change Password</b>
                    </div>
                    <div class="col-lg-6">
                      <p class="text-muted">Change your password often for a more secure access to account.</p>
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
@endsection

@section('javascript')
  <!-- Tags JavaScript -->
  <script src="{{asset('js/select2.min.js')}}"></script>

  <script type="text/javascript">
    $('.select2-multi').select2();

    $('.select2-multi').select2().val({!! json_encode($faculty->field()->allRelatedIds()) !!}).trigger('change');
  </script>
  <script type="text/javascript">
    $('.select1-multi').select2();

    $('.select1-multi').select2().val({!! json_encode($faculty->needs()->allRelatedIds()) !!}).trigger('change');
  </script>
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
            confirm("Are you sure you want to cancel update?");
      });
      $(document).on("click", ".submit", function(e) {
              confirm("Confirm and Save Data?");
      });
  </script>

  {!! Html::script('js/parsley.min.js') !!}
@endsection
