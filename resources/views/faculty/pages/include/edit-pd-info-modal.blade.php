<div class="modal fade" id="addOtherFields" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
    <div class="modal-content">
      {!! Form::open(['route' => 'addOtherFields', 'method' => 'POST']) !!}
        <div class="card-block">
          {{-- header --}}
          <div class="text-xs-center">
            <h3><i class="fa fa-book"></i> Add other Field of Specialization</h3>
            <hr class="mt-2 mb-2">
          </div>
          {{-- body --}}
          <div class="md-form">
            <input type="text" name="name" value="">
          </div>
          <hr>
            <div class="md-form">
              <input type="hidden" name="_token" value="{{Session::token()}}">
              <input type="hidden" name="faculty_id" value="{{Auth::id()}}">
              <button class="btn green pull-right" type="submit" name="button" value="submit"><i class="fa fa-floppy-o"></i> Submit</button>
              <button class="btn red pull-right" type="cancel" data-dismiss="modal" value="Cancel" > <i class="fa fa-times"></i> Cancel</button>
            </div>
        </div>
        {!! Form::close() !!}
      </div>
    <!--/.Content-->
    </div>
</div>

@foreach ($seminars as $seminar)
  <div class="modal fade" id="submit-{{$seminar->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <!--Content-->
      <div class="modal-content">
        {!! Form::model($seminar, ['route' => ['updatepdactivity', $seminar->id],'data-parsley-validate' => '','method' => 'PUT', 'files' => true]) !!}
          <div class="card-block">
            {{-- header --}}
            <div class="text-xs-center">
              <h3><i class="fa fa-university"></i> Submit Certificate</h3>
              <hr class="mt-2 mb-2">
            </div>

            {{-- body --}}
            <div class="md-form">
                <b>Upload Certificate </b><em class="text-danger">(use image file type only .jpg, .png, .gif, .svg)</em> <br> <input type="file" name="file" required>
            </div>
            <hr>
              <div class="md-form">
                {{-- <input type="hidden" name="_method" value="PUT"> --}}
                <input type="hidden" name="p_dactivity_id" value="{{$seminar->id}}">
                <input type="hidden" name="faculty_id" value="{{Auth::id()}}">
                <input type="hidden" name="createdBy" value="{{Auth::id()}}">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <button class="btn green pull-right" type="submit" name="button" value="submit"><i class="fa fa-floppy-o"></i> Save Changes</button>
                <button class="btn red pull-right" type="cancel" data-dismiss="modal" value="Cancel" > <i class="fa fa-times"></i> Cancel</button>
              </div>
          </div>
          {!! Form::close() !!}
        </div>
      <!--/.Content-->
      </div>
  </div>

    <div class="modal fade" id="seminar-{{$seminar->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!--Content-->
        <div class="modal-content">
          {!! Form::model($seminar, ['route' => ['updatepdrecord', $seminar->id],'data-parsley-validate' => '','method' => 'PUT', 'files' => true]) !!}
            <div class="card-block">
              {{-- header --}}
              <div class="text-xs-center">
                <h3><i class="fa fa-university"></i> Seminar/Conference Information</h3>
                <hr class="mt-2 mb-2">
              </div>

              {{-- body --}}
              <div class="md-form">
                {{ Form::label('title', 'Title')}}
                {{ Form::text('title', Input::old( 'title', $seminar-> title ),  ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title of the activity','required' => ''])}}
              </div>
              <div class="md-form">
                {{ Form::label('venue', 'Venue')}}
                {{ Form::text('venue', Input::old( 'venue', $seminar-> venue ),  ['class' => 'form-control', 'id' => 'venue', 'placeholder' => 'Venue of the activity', 'required' => ''])}}
              </div>
              <div class="md-form">
                {{ Form::label('sponsor', 'Sponsor')}}
                {{ Form::text('sponsor', Input::old( 'sponsor', $seminar-> sponsor ),  ['class' => 'form-control', 'id' => 'sponsor', 'placeholder' => 'Sponsor of the activity', 'required' => ''])}}
              </div>
              <div class="form-inline">
                  <div class="md-form form-group">
                    {{ Form::label('dateFrom', 'Date From')}}
                    {{ Form::text('dateFrom', Input::old( 'dateFrom', $seminar-> dateFrom ),  ['class' => 'form-control', 'id' => 'datepickerFromS', 'placeholder' => 'Start date of the activity', 'required' => ''])}}
                  </div>
                  <div class="md-form form-group">
                    {{ Form::label('dateTo', 'Date To')}}
                    {{ Form::text('dateTo', Input::old( 'dateTo', $seminar-> dateTo ),  ['class' => 'form-control', 'id' => 'datepickerToS', 'placeholder' => 'Title of the activity','required' => ''])}}
                  </div>
              </div>
              <div class="md-form">
                {{ Form::label('details', 'Details')}}
                {{ Form::text('details', Input::old( 'details', $seminar-> details ),  ['class' => 'form-control', 'id' => 'details', 'placeholder' => 'Provide a report about the activity','required' => ''])}}
              </div>
              <div class="md-form">
                  <b>Upload Certificate </b><em class="text-danger">(use image file type only .jpg, .png, .gif, .svg)</em> <br> <input type="file" name="file">
              </div>
              <hr>
                <div class="md-form">
                  {{-- <input type="hidden" name="_method" value="PUT"> --}}
                  <input type="hidden" name="p_dcategory_id" value="1">
                  <input type="hidden" name="faculty_id" value="{{Auth::id()}}">
                  <input type="hidden" name="createdBy" value="{{Auth::id()}}">
                  <input type="hidden" name="_token" value="{{Session::token()}}">
                  <button class="btn green pull-right" type="submit" name="button" value="submit"><i class="fa fa-floppy-o"></i> Save Changes</button>
                  <button class="btn red pull-right" type="cancel" data-dismiss="modal" value="Cancel" > <i class="fa fa-times"></i> Cancel</button>
                </div>
            </div>
            {!! Form::close() !!}
          </div>
        <!--/.Content-->
        </div>
      </div>
@endforeach
<!--/. end seminar Modal-->

<!--training Modal-->
@foreach ($trainings as $training)
  <div class="modal fade" id="submit-{{$training->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <!--Content-->
      <div class="modal-content">
        {!! Form::model($training, ['route' => ['updatepdactivity', $training->id],'data-parsley-validate' => '','method' => 'PUT', 'files' => true]) !!}
          <div class="card-block">
            {{-- header --}}
            <div class="text-xs-center">
              <h3><i class="fa fa-university"></i> Submit Certificate</h3>
              <hr class="mt-2 mb-2">
            </div>

            {{-- body --}}
            <div class="md-form">
                <b>Upload Certificate </b><em class="text-danger">(use image file type only .jpg, .png, .gif, .svg)</em> <br> <input type="file" name="file" required>
            </div>
            <hr>
              <div class="md-form">
                {{-- <input type="hidden" name="_method" value="PUT"> --}}
                <input type="hidden" name="p_dactivity_id" value="{{$training->id}}">
                <input type="hidden" name="faculty_id" value="{{Auth::id()}}">
                <input type="hidden" name="createdBy" value="{{Auth::id()}}">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <button class="btn green pull-right" type="submit" name="button" value="submit"><i class="fa fa-floppy-o"></i> Save Changes</button>
                <button class="btn red pull-right" type="cancel" data-dismiss="modal" value="Cancel" > <i class="fa fa-times"></i> Cancel</button>
              </div>
          </div>
          {!! Form::close() !!}
        </div>
      <!--/.Content-->
      </div>
  </div>

  <div class="modal fade" id="training-{{$training->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <!--Content-->
      <div class="modal-content">
        {!! Form::model($training, ['route' => ['updatepdrecord', $training->id],'method' => 'PUT', 'files' => true]) !!}
          <div class="card-block">
            {{-- header --}}
            <div class="text-xs-center">
              <h3><i class="fa fa-university"></i> Training and Workshop Information</h3>
              <hr class="mt-2 mb-2">
            </div>

            {{-- body --}}
            <div class="md-form">
              {{ Form::label('title', 'Title')}}
              {{ Form::text('title', Input::old( 'title', $training-> title ),  ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title of the activity','required' => ''])}}
            </div>
            <div class="md-form">
              {{ Form::label('venue', 'Venue')}}
              {{ Form::text('venue', Input::old( 'venue', $training-> venue ),  ['class' => 'form-control', 'id' => 'venue', 'placeholder' => 'Venue of the activity', 'required' => ''])}}
            </div>
            <div class="md-form">
              {{ Form::label('sponsor', 'Sponsor')}}
              {{ Form::text('sponsor', Input::old( 'sponsor', $training-> sponsor ),  ['class' => 'form-control', 'id' => 'sponsor', 'placeholder' => 'Sponsor of the activity', 'required' => ''])}}
            </div>
            <div class="form-inline">
                <div class="md-form form-group">
                  {{ Form::label('dateFrom', 'Date From')}}
                  {{ Form::text('dateFrom', Input::old( 'dateFrom', $training-> dateFrom ),  ['class' => 'form-control', 'id' => 'datepickerFromS', 'placeholder' => 'Start date of the activity', 'required' => ''])}}
                </div>
                <div class="md-form form-group">
                  {{ Form::label('dateTo', 'Date To')}}
                  {{ Form::text('dateTo', Input::old( 'dateTo', $training-> dateTo ),  ['class' => 'form-control', 'id' => 'datepickerToS', 'placeholder' => 'Title of the activity','required' => ''])}}
                </div>
            </div>
            <div class="md-form">
              {{ Form::label('details', 'Details')}}
              {{ Form::text('details', Input::old( 'details', $training-> details ),  ['class' => 'form-control', 'id' => 'details', 'placeholder' => 'Provide a report about the activity','required' => ''])}}
            </div>
            <div class="md-form">
              <b>Upload Certificate </b><em class="text-danger">(use image file type only .jpg, .png, .gif, .svg)</em> <br> <input type="file" name="file" required="">
            </div>
            <hr>
            <center>
              <div class="md-form">
                <button class="btn red" type="cancel" data-dismiss="modal" value="Cancel" > <i class="fa fa-times"></i> Cancel</button>
                <button class="btn green" type="submit" name="button" value="submit"><i class="fa fa-floppy-o"></i> Save Changes</button>
                {{-- <input type="hidden" name="_method" value="PUT"> --}}
                <input type="hidden" name="p_dcategory_id" value="2">
                <input type="hidden" name="faculty_id" value="{{Auth::id()}}">
                <input type="hidden" name="createdBy" value="{{Auth::id()}}">
                <input type="hidden" name="_token" value="{{Session::token()}}">
              </div>
            </center>
          </div>
          {!! Form::close() !!}
        </div>
      <!--/.Content-->
      </div>
    </div>
@endforeach
<!--/. end training Modal-->

<!--shortcourse Modal-->
@foreach ($courses as $course)
  <div class="modal fade" id="submit-{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <!--Content-->
      <div class="modal-content">
        {!! Form::model($course, ['route' => ['updatepdactivity', $course->id],'data-parsley-validate' => '','method' => 'PUT', 'files' => true]) !!}
          <div class="card-block">
            {{-- header --}}
            <div class="text-xs-center">
              <h3><i class="fa fa-university"></i> Submit Certificate</h3>
              <hr class="mt-2 mb-2">
            </div>

            {{-- body --}}
            <div class="md-form">
                <b>Upload Certificate </b><em class="text-danger">(use image file type only .jpg, .png, .gif, .svg)</em> <br> <input type="file" name="file" required>
            </div>
            <hr>
              <div class="md-form">
                {{-- <input type="hidden" name="_method" value="PUT"> --}}
                <input type="hidden" name="p_dactivity_id" value="{{$course->id}}">
                <input type="hidden" name="faculty_id" value="{{Auth::id()}}">
                <input type="hidden" name="createdBy" value="{{Auth::id()}}">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <button class="btn green pull-right" type="submit" name="button" value="submit"><i class="fa fa-floppy-o"></i> Save Changes</button>
                <button class="btn red pull-right" type="cancel" data-dismiss="modal" value="Cancel" > <i class="fa fa-times"></i> Cancel</button>
              </div>
          </div>
          {!! Form::close() !!}
        </div>
      <!--/.Content-->
      </div>
  </div>

  <div class="modal fade" id="shortcourse-{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <!--Content-->
      <div class="modal-content">
        {!! Form::model($course, ['route' => ['updatepdrecord', $course->id],'method' => 'PUT', 'files' => true]) !!}
          <div class="card-block">
            {{-- header --}}
            <div class="text-xs-center">
              <h3><i class="fa fa-university"></i> Short Course Details</h3>
              <hr class="mt-2 mb-2">
            </div>

            {{-- body --}}
            <div class="md-form">
              {{ Form::label('title', 'Title')}}
              {{ Form::text('title', Input::old( 'title', $course-> title ),  ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title of the activity','required' => ''])}}
            </div>
            <div class="md-form">
              {{ Form::label('venue', 'Venue')}}
              {{ Form::text('venue', Input::old( 'venue', $course-> venue ),  ['class' => 'form-control', 'id' => 'venue', 'placeholder' => 'Venue of the activity', 'required' => ''])}}
            </div>
            <div class="md-form">
              {{ Form::label('sponsor', 'Sponsor')}}
              {{ Form::text('sponsor', Input::old( 'sponsor', $course-> sponsor ),  ['class' => 'form-control', 'id' => 'sponsor', 'placeholder' => 'Sponsor of the activity', 'required' => ''])}}
            </div>
            <div class="form-inline">
                <div class="md-form form-group">
                  {{ Form::label('dateFrom', 'Date From')}}
                  {{ Form::text('dateFrom', Input::old( 'dateFrom', $course-> dateFrom ),  ['class' => 'form-control', 'id' => 'datepickerFromS', 'placeholder' => 'Start date of the activity', 'required' => ''])}}
                </div>
                <div class="md-form form-group">
                  {{ Form::label('dateTo', 'Date To')}}
                  {{ Form::text('dateTo', Input::old( 'dateTo', $course-> dateTo ),  ['class' => 'form-control', 'id' => 'datepickerToS', 'placeholder' => 'Title of the activity','required' => ''])}}
                </div>
            </div>
            <div class="md-form">
              {{ Form::label('details', 'Details')}}
              {{ Form::text('details', Input::old( 'details', $course-> details ),  ['class' => 'form-control', 'id' => 'details', 'placeholder' => 'Provide a report about the activity','required' => ''])}}
            </div>
            <div class="md-form">
              <b>Upload Certificate </b><em class="text-danger">(use image file type only .jpg, .png, .gif, .svg)</em> <br> <input type="file" name="file" required="">
            </div>
            <hr>
            <center>
              <div class="md-form">
                <button class="btn red" type="cancel" data-dismiss="modal" value="Cancel" > <i class="fa fa-times"></i> Cancel</button>
                <button class="btn green" type="submit" name="button" value="submit"><i class="fa fa-floppy-o"></i> Save Changes</button>
                {{-- <input type="hidden" name="_method" value="PUT"> --}}
                <input type="hidden" name="p_dcategory_id" value="4">
                <input type="hidden" name="faculty_id" value="{{Auth::id()}}">
                <input type="hidden" name="createdBy" value="{{Auth::id()}}">
                <input type="hidden" name="_token" value="{{Session::token()}}">
              </div>
            </center>
          </div>
          {!! Form::close() !!}
        </div>
      <!--/.Content-->
      </div>
    </div>
@endforeach
<!--/. end shortcourse Modal-->
