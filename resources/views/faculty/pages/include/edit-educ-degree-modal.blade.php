@foreach ($educbackground as $educbackgrounds)
<!--bacc Modal-->
  <div class="modal fade"
      @if ($educbackgrounds->category->id == 1)
        id="bacc"
      @elseif ($educbackgrounds->category->id == 2)
        id="masteral"
      @elseif ($educbackgrounds->category->id == 3)
        id="doc"
      @endif
  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">


      <div class="modal-dialog" role="document">
          <!--Content-->
      <div class="modal-content">
        {!! Form::model($educbackgrounds, ['route' => ['educbackground.update', $educbackgrounds->id], 'data-parsley-validate' => '', 'method' => 'PUT']) !!}
          <div class="card-block">
            {{-- header --}}
            <div class="text-xs-center">
              <h3><i class="fa fa-university"></i> {{$educbackgrounds->category->name}}</h3>
              <hr class="mt-2 mb-2">
            </div>

            {{-- body --}}
            <div class="md-form">
              {{ Form::label('course', 'Course')}}
              {{ Form::text('course', Input::old( 'course', $educbackgrounds-> course ),  ['class' => 'form-control', 'id' => 'course', 'placeholder' => 'Your Course', 'required' => ''])}}
            </div>
            <div class="md-form">
              {{ Form::label('major', 'Major')}}
              {{ Form::text('major', Input::old( 'major', $educbackgrounds-> major ), ['class' => 'form-control', 'id' => 'major', 'placeholder' => 'Your Major if any...'])}}
            </div>
            <div class="md-form">
              {{ Form::label('school', 'School')}}
              {{ Form::text('school', Input::old( 'school', $educbackgrounds-> school ), ['class' => 'form-control', 'id' => 'school', 'placeholder' => 'Write in full...', 'required' => ''])}}
            </div>
            <div class="md-form">
              {{ Form::label('scholarship', 'Scholarship')}}
              {{ Form::text('scholarship', Input::old( 'scholarship', $educbackgrounds-> scholarship ), ['class' => 'form-control', 'id' => 'scholarship', 'placeholder' => 'Your scholarship grant if any...'])}}
            </div>
            <div class="md-form">
              {{ Form::label('award', 'Award')}}
              {{ Form::text('award', Input::old( 'award', $educbackgrounds-> award ), ['class' => 'form-control', 'id' => 'award', 'placeholder' => 'Your award grant if any...'])}}
            </div>
            <div class="form-inline">
              <div class="md-form form-group">
                {{ Form::label('yearstarted', 'Year Started')}}
                {{ Form::number('yearstarted', Input::old( 'yearstarted', $educbackgrounds-> yearstarted ), ['class' => 'form-control', 'id' => 'yearstarted', 'placeholder' => 'Enter Year Started', 'data-parsley-type' => 'integer', 'required' => '', 'data-parsley-min' => '4'])}}
              </div>
              <div class="md-form form-group">
                <input type="checkbox" onclick="var input = document.getElementById('yeargraduated'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}" />
                {{ Form::label('yeargraduated', 'Year Graduated')}}
                {{ Form::number('yeargraduated', Input::old( 'yeargraduated', $educbackgrounds-> yeargraduated ), ['class' => 'form-control', 'id' => 'yeargraduated', 'placeholder' => 'Check if graduated', 'data-parsley-type' => 'integer', 'data-parsley-min' => '4', 'data-parsley-max' => '4',])}}
              </div>
            </div>
            <hr>
            <center>
              <div class="md-form">
                <button class="btn red" type="cancel" data-dismiss="modal" value="Cancel" > <i class="fa fa-times"></i> Cancel</button>
                <button class="btn green" type="submit" name="button" value="submit"><i class="fa fa-floppy-o"></i> Save Changes</button>
                <input type="hidden" name="educ_category_id" value="{{$educbackgrounds->category->id}}">
                <input type="hidden" name="faculty_id" value="{{$faculty->id}}">
                <input type="hidden" name="_token" value="{{Session::token()}}">
              </div>
            </center>
          </div>
          {!! Form::close() !!}
        </div>
      <!--/.Content-->
      </div>
    </div>
    <!--/. end bacc Modal-->
@endforeach
