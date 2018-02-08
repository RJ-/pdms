@extends('layouts.adminMaster')

@section('title')
  Edit Activity
@endsection

@section('stylesheets')

  <!-- Datepicker CSS -->
  <link href="{{ asset('datepicker/jquery.datetimepicker.css')}}" rel="stylesheet">
  <!-- Tags CSS -->
  <link href="{{ asset('css/select2.min.css')}}" rel="stylesheet">

  <script src="{{asset('tinymce/js/tinymce/tinymce.min.js')}}"></script>

  <script type="text/javascript">
    tinymce.init({
      selector: 'textarea',
      menubar: false
    });
  </script>

@endsection

@section('content')

  @section('header')
    <b>Edit Activity</b>
  @endsection


  <div class="row">
    <div class="col-md-offset-3">
    {!! Form::model($activity, ['route' => ['pdactivity.update', $activity->id], 'data-parsley-validate' => '',
      'method' => 'PUT'])!!}
    <!--First row-->
      <div class="row">
          <div class="col-md-8">
              <div class="md-form">
                {{ Form::label('title', 'Activity Title')}}
                {{ Form::text('title', null, ['class' => 'form-control', 'required' => ''])}}
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-8">
              <div class="md-form">
                {{ Form::label('venue', 'Venue')}}
                {{ Form::text('venue', null, ['class' => 'form-control', 'required' => ''])}}
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-8">
              <div class="md-form">
                {{ Form::label('sponsor', 'Sponsors')}}
                {{ Form::text('sponsor', null, ['class' => 'form-control', 'required' => ''])}}
              </div>
          </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="md-form">
            {{ Form::label('dateFrom', 'Date From')}}
            {{ Form::text('dateFrom', null, ['class' => 'form-control', 'id' => 'datepickerFrom', 'required' => ''])}}
          </div>
        </div>
        <div class="col-md-4">
          <div class="md-form">
            {{ Form::label('dateTo', 'Date To')}}
            {{ Form::text('dateTo', null, ['class' => 'form-control', 'id' => 'datepickerTo', 'required' => ''])}}
          </div>
        </div>
      </div>
      <!--/.First row-->

      <!--Second row-->
      <div class="row">
          <div class="col-md-8">
              {{ Form::label('details', 'Details')}}
              <div class="md-form">
                {{ Form::textarea('details', null, ['class' => 'form-control', 'required' => ''])}}
              </div>

          </div>
      </div>
      <!--/.Second row-->

      <div class="row">
        <div class="col-md-8">
            <h4 class="page-header"><b>Activity Category</b></h4>
            <div class="md-form">
              {{ Form::select('p_dcategory_id', $pdcategory, null, ['class' => 'form-control']) }}
            </div>

        <h4 class="page-header"><b>Select Tagging Option</b><em class="text-danger"> (Please select a single tagging option only.)</em></h4>


            <h4 class="page-header">
              <input type="checkbox" onclick="var input = document.getElementById('needs'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}" />
              <b>Tag Faculty Needs Category</b> <em class="text-primary">(General Tagging Option)</em>
            </h4>
            <div class="md-form">
              {{ Form::select('training_needs_id', $needs, null, ['class' => 'form-control', 'disabled' => 'disabled', 'id'=>'needs']) }}

            </div>

            <h4 class="page-header">
              <input type="checkbox" onclick="var input = document.getElementById('fields'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}" />
              <b>Tag Related Fields</b> <em class="text-primary">(Specific Tagging Option)</em>
            </h4>
            <div class="md-form">
                <select class="form-control select2-multi" name="fields[]" multiple="multiple" disabled="disabled" name="fields" id="fields" >
                  @foreach ($categories as $category)
                    <optgroup label="{{$category->name}}">
                      @foreach ($category->field as $fields)
                        <option value="{{$fields->id}}">{{$fields->name}}</option>
                      @endforeach
                  @endforeach
                </select>
            </div>
        </div>
      </div>

      <div class="row">
        <br/>
        <center>
        <div class="col-md-8">
          {{ Form::button('<i class="fa fa-eraser"></i> Cancel', ['class' => 'btn btn-warning btn-lg cancel', 'onclick' => "goBack()"])}}
          <button class="btn green btn-lg save" type="submit" name="button" value="Submit">
            <i class="fa fa-floppy-o"></i>  Save Changes
          </button>
        <input type="hidden" name="_token" value="{{Session::token()}}">
        {!! Form::close() !!}

      </div>
      </div>
  </div><!--/.offset-->

  </div><!--/.row-->
@endsection

@section('javascript')
  <!-- Tags JavaScript -->
  <script src="{{asset('js/select2.min.js')}}"></script>

  <script type="text/javascript">
    $('.select2-multi').select2();

    $('.select2-multi').select2().val({!! json_encode($activity->field()->allRelatedIds())
    !!}).trigger('change');
  </script>
  {{-- <script type="text/javascript">
    $('.select1-multi').select2();

    $('.select1-multi').select2().val({!! json_encode($activity->needs()->getRelatedIds())
    !!}).trigger('change');
  </script> --}}
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
  </script>

  <script type="text/javascript">
      $(document).on("click", ".save", function(e) {
        if (confirm("Confirm and save all changes made?")) {
        }else{
          e.preventDefault();
        }
      });
  </script>
@endsection
