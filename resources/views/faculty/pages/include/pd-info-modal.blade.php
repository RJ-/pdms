<!--seminar Modal-->
  <div class="modal fade" id="seminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <!--Content-->
      <div class="modal-content">
      <form class="form-group" action="{{route('faculty.store', $faculty->id)}}" method="post" data-parsley-validate="" enctype="multipart/form-data">
          <div class="card-block">
            {{-- header --}}
            <div class="text-xs-center">
              <h3><i class="fa fa-university"></i> Seminar/Conference Information</h3>
              <hr class="mt-2 mb-2">
            </div>

            {{-- body --}}
            <div class="md-form">
              <input placeholder="Title of the activity" type="text" class="form-control"  name="title" id="title" value="{{Request::old('title')}}" required="">
              <label for="title">Title</label>
            </div>
            <div class="md-form">
              <input placeholder="Venue of the activity" type="text" class="form-control"  name="venue" id="venue" value="{{Request::old('venue')}}" required="">
              <label for="venue">Venue</label>
            </div>
            <div class="md-form">
              <input placeholder="Sponsor of the activity" type="text" class="form-control"  name="sponsor" id="sponsor" value="{{Request::old('sponsor')}}" required="">
              <label for="sponsor">Sponsor</label>
            </div>
            <div class="form-inline">
                <div class="md-form form-group">
                  <input placeholder="Start date of the activity" type="text" class="form-control"  name="dateFrom" id="datepickerFromS" value="{{Request::old('dateFrom')}}" required="">
                  <label for="dateFrom">Date From</label>
                </div>
                <div class="md-form form-group">
                  <input placeholder="End date of the activity" type="text" class="form-control"  name="dateTo" id="datepickerToS" value="{{Request::old('dateTo')}}" required="">
                  <label for="dateTo">Date To</label>
                </div>
            </div>
            <div class="md-form">
              <input placeholder="Provide a report about the activity" type="text" class="form-control"  name="details" id="details" value="{{Request::old('details')}}" required="">
              <label for="details">Details</label>
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
                <input type="hidden" name="p_dcategory_id" value="1">
                <input type="hidden" name="faculty_id" value="{{Auth::id()}}">
                <input type="hidden" name="createdBy" value="{{Auth::id()}}">
                <input type="hidden" name="_token" value="{{Session::token()}}">
              </div>
            </center>
          </div>
        </form>
        </div>
      <!--/.Content-->
      </div>
    </div>
<!--/. end seminar Modal-->

<!--training Modal-->
  <div class="modal fade" id="training" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <!--Content-->
      <div class="modal-content">
      <form class="form-group" action="{{route('faculty.store', $faculty->id)}}" method="post" data-parsley-validate="" enctype="multipart/form-data">
          <div class="card-block">
            {{-- header --}}
            <div class="text-xs-center">
              <h3><i class="fa fa-university"></i> Training and Workshop Information</h3>
              <hr class="mt-2 mb-2">
            </div>

            {{-- body --}}
            <div class="md-form">
              <input placeholder="Title of the activity" type="text" class="form-control"  name="title" id="title" value="{{Request::old('title')}}" required="">
              <label for="title">Title</label>
            </div>
            <div class="md-form">
              <input placeholder="Venue of the activity" type="text" class="form-control"  name="venue" id="venue" value="{{Request::old('venue')}}" required="">
              <label for="venue">Venue</label>
            </div>
            <div class="md-form">
              <input placeholder="Sponsor of the activity" type="text" class="form-control"  name="sponsor" id="sponsor" value="{{Request::old('sponsor')}}" required="">
              <label for="sponsor">Sponsor</label>
            </div>
            <div class="form-inline">
                <div class="md-form form-group">
                  <input placeholder="Start date of the activity" type="text" class="form-control"  name="dateFrom" id="datepickerFrom" value="{{Request::old('dateFrom')}}" required="">
                  <label for="dateFrom">Date From</label>
                </div>
                <div class="md-form form-group">
                  <input placeholder="End date of the activity" type="text" class="form-control"  name="dateTo" id="datepickerTo" value="{{Request::old('dateTo')}}" required="">
                  <label for="dateTo">Date To</label>
                </div>
            </div>
            <div class="md-form">
              <input placeholder="Provide a report about the activity" type="text" class="form-control"  name="details" id="details" value="{{Request::old('details')}}" required="">
              <label for="details">Details</label>
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
        </form>
        </div>
      <!--/.Content-->
      </div>
    </div>
<!--/. end training Modal-->

<!--shortcourse Modal-->
  <div class="modal fade" id="shortcourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <!--Content-->
      <div class="modal-content">
      <form class="form-group" action="{{route('faculty.store', $faculty->id)}}" method="post" data-parsley-validate="" enctype="multipart/form-data">
          <div class="card-block">
            {{-- header --}}
            <div class="text-xs-center">
              <h3><i class="fa fa-university"></i> Short Course Details</h3>
              <hr class="mt-2 mb-2">
            </div>

            {{-- body --}}
            <div class="md-form">
              <input placeholder="Title of the activity" type="text" class="form-control"  name="title" id="title" value="{{Request::old('title')}}" required="">
              <label for="title">Title</label>
            </div>
            <div class="md-form">
              <input placeholder="Venue of the activity" type="text" class="form-control"  name="venue" id="venue" value="{{Request::old('venue')}}" required="">
              <label for="venue">Venue</label>
            </div>
            <div class="md-form">
              <input placeholder="Sponsor of the activity" type="text" class="form-control"  name="sponsor" id="sponsor" value="{{Request::old('sponsor')}}" required="">
              <label for="sponsor">Sponsor</label>
            </div>
            <div class="form-inline">
                <div class="md-form form-group">
                  <input placeholder="Start date of the activity" type="text" class="form-control"  name="dateFrom" id="datepickerFromSh" value="{{Request::old('dateFrom')}}" required="">
                  <label for="dateFrom">Date From</label>
                </div>
                <div class="md-form form-group">
                  <input placeholder="End date of the activity" type="text" class="form-control"  name="dateTo" id="datepickerToSh" value="{{Request::old('dateTo')}}" required="">
                  <label for="dateTo">Date To</label>
                </div>
            </div>
            <div class="md-form">
              <input placeholder="Provide a report about the activity" type="text" class="form-control"  name="details" id="details" value="{{Request::old('details')}}" required="">
              <label for="details">Details</label>
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
        </form>
        </div>
      <!--/.Content-->
      </div>
    </div>
<!--/. end shortcourse Modal-->
