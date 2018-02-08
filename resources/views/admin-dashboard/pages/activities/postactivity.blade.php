@extends('layouts.adminMaster')

@section('title')
  Post Activity
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
    <b>Post Professional Development Activity</b>
  @endsection

  <div class="row">
    <div class="col-md-offset-3">
    <form class="" action="{{route('pdactivity.store')}}" method="post" data-parsley-validate = "">
    <!--First row-->
      <div class="row">
          <div class="col-md-8">
              <div class="md-form">
                  <input type="text" id="form41" class="form-control" name="title" required = "">
                  <label for="form41" class="">Title</label>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-8">
              <div class="md-form">
                  <input type="text" id="form41" class="form-control" name="venue" required = "">
                  <label for="form41" class="">Venue</label>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-8">
              <div class="md-form">
                  <input type="text" id="form41" class="form-control" name="sponsor" required = "">
                  <label for="form41" class="">Sponsor</label>
              </div>
          </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="md-form">
            <input type="text" id="datepickerFrom" class="form-control" name="dateFrom" required = "">
            <label for="form76">Date From</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="md-form">
            <input type="text" id="datepickerTo" class="form-control" name="dateTo" required = "">
            <label for="form76">Date To</label>
          </div>
        </div>
      </div>
      <!--/.First row-->

      <!--Second row-->
      <div class="row">
          <div class="col-md-8">
            <h4 class="page-header"><b>Description</b></h4>
              <div class="md-form">
                  <label for="form76"></label>
                  <textarea type="text" id="form76" class="md-textarea" name="details" required = ""></textarea>
              </div>

          </div>
      </div>
      <!--/.Second row-->

      <div class="row">
        <div class="col-md-8">
            <h4 class="page-header"><b>Activity Category</b></h4>
            <div class="md-form">
                <select class="form-control" name="p_dcategory_id">
                  @foreach ($pdcategories as $pdcategory)
                    <option value="{{$pdcategory->id}}">{{$pdcategory->name}}</option>
                  @endforeach
                </select>
            </div>

            <h4 class="page-header"><b>Select Tagging Option</b>
              <em class="text-danger">(Select only one tagging option)</em>
            </h4>

            <h4 class="page-header">
              <input type="checkbox" onclick="var input = document.getElementById('needs'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}" />
              <b>Tag Faculty Needs Category</b> <em class="text-primary">(General Tagging Option)</em>
            </h4>
            <div class="md-form">
                <select class="form-control" name="training_needs_id" disabled="disabled" name="needs" id="needs" >
                  @foreach ($needs as $need)
                    <option value="{{$need->id}}">{{$need->name}}</option>
                  @endforeach
                </select>
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
            <i class="fa fa-floppy-o"></i>  Post Activity
          </button>
        <input type="hidden" name="_token" value="{{Session::token()}}">
      </div>
      </div>
    </form>

    {{-- <div class="row">
      <div class="col-md-8">
          <h3 class="page-header">Suggested Faculties</h3>
      </div>
    </div>
  </div><!--/.offset-->
      <div class="row">
        <div class="nav-center">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs centered md-pills pills-ins " role="tablist">
              <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#panel11" role="tab">Priority</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#panel12" role="tab">Relevance</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#panel13" role="tab">Needs</a>
              </li>
          </ul>
        </div>
        <!-- Tab panels -->
        <div class="tab-content">

            <!--Panel 1-->
            <div class="tab-pane fade in active" id="panel11" role="tabpanel">
              <div class="row">
                <div class="col-md-offset-3">
                <div class="col-md-4">
                  <h3><i class="fa fa-user prefix"></i> Bill Gates</h3>
                </div>
                <div class="col-md-4">
                  <h3><i class="fa fa-user prefix"></i> Steve Jobs</h3>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-offset-3">
                <div class="col-md-4">
                  <h3><i class="fa fa-user prefix"></i> Bill Gates</h3>
                </div>
                <div class="col-md-4">
                  <h3><i class="fa fa-user prefix"></i> Steve Jobs</h3>
                </div>
                </div>
              </div>
            </div>
            <!--/.Panel 1-->

            <!--Panel 2-->
            <div class="tab-pane fade" id="panel12" role="tabpanel">
                <br>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta doloribus reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora, placeat ratione porro voluptate
                    odit minima.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta doloribus reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora, placeat ratione porro voluptate
                    odit minima.</p>

            </div>
            <!--/.Panel 2-->

            <!--Panel 3-->
            <div class="tab-pane fade" id="panel13" role="tabpanel">
                <br>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta doloribus reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora, placeat ratione porro voluptate
                    odit minima.</p>

            </div>
            <!--/.Panel 3-->

            <!--Panel 4-->
            <div class="tab-pane fade" id="panel14" role="tabpanel">
                <br>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta doloribus reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora, placeat ratione porro voluptate
                    odit minima.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta doloribus reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora, placeat ratione porro voluptate
                    odit minima.</p>

            </div>
            <!--/.Panel 4-->

        </div>
      </div> --}}
  </div><!--/.row-->
@endsection

@section('javascript')
  <!-- Tags JavaScript -->
  <script src="{{asset('js/select2.min.js')}}"></script>

  <script type="text/javascript">
    $('.select2-multi').select2();
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
