<!--bacc Modal-->
  <div class="modal fade" id="bacc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <!--Content-->
      <div class="modal-content">
      <form class="form-group" action="{{route('educbackground.store', $faculty->id)}}" method="post" data-parsley-validate=" ">
          <div class="card-block">
            {{-- header --}}
            <div class="text-xs-center">
              <h3><i class="fa fa-university"></i> Baccalaureate Degree</h3>
              <hr class="mt-2 mb-2">
            </div>

            {{-- body --}}
            <div class="md-form">
              <input placeholder="Your Course" type="text" class="form-control"  name="course" id="course" value="{{Request::old('course')}}" required="">
              <label for="course">Course</label>
            </div>
            <div class="md-form">
              <input placeholder="Your Major if any..." type="text" class="form-control"  name="major" id="major" value="{{Request::old('major')}}">
              <label for="major">Major</label>
            </div>
            <div class="md-form">
              <input placeholder="Write in full..." type="text" class="form-control"  name="school" id="school" value="{{Request::old('school')}}" required="">
              <label for="school">School</label>
            </div>
            <div class="md-form">
              <input placeholder="Your scholarship grant if any..." type="text" class="form-control"  name="scholarship" id="scholarship" value="{{Request::old('scholarship')}}">
              <label for="scholarship">Scholarship</label>
            </div>
            <div class="md-form">
              <input placeholder="Your award grant if any..." type="text" class="form-control"  name="award" id="award" value="{{Request::old('award')}}">
              <label for="scholarship">Award</label>
            </div>
            <div class="form-inline">
              <div class="md-form form-group">
                <input placeholder="2017" type="number" class="form-control"  name="yearstarted" id="yearstarted" value="{{Request::old('yearstarted')}}" data-parsley-type="integer" data-parsley-min="4" required="">
                <label for="yearstarted">Year Started</label>
              </div>
              <div class="md-form form-group">
                <input type="checkbox" onclick="var input = document.getElementById('yeargraduated'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}" />
                <input placeholder="Check if graduated" type="number" class="form-control" disabled="disabled"   name="yeargraduated" id="yeargraduated" value="{{Request::old('yeargraduated')}}" data-parsley-type = "integer" min="4">
                <label for="yeargraduated">Year Graduated</label>
              </div>
            </div>
            <hr>
            <center>
              <div class="md-form">
                <button class="btn red" type="cancel" data-dismiss="modal" value="Cancel" > <i class="fa fa-times"></i> Cancel</button>
                <button class="btn green" type="submit" name="button" value="submit"><i class="fa fa-floppy-o"></i> Save Changes</button>
                {{-- <input type="hidden" name="_method" value="PUT"> --}}
                <input type="hidden" name="educ_category_id" value="1">
                <input type="hidden" name="faculty_id" value="{{$faculty-> id}}">
                <input type="hidden" name="_token" value="{{Session::token()}}">
              </div>
            </center>
          </div>
        </form>
        </div>
      <!--/.Content-->
      </div>
    </div>
    <!--/. end bacc Modal-->

    <!--Masters Modal-->
      <div class="modal fade" id="masteral" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <!--Content-->
          <div class="modal-content">
            <form class="form-group" action="{{route('educbackground.store', $faculty->id)}}" method="post">
                <div class="card-block">
                  {{-- header --}}
                  <div class="text-xs-center">
                    <h3><i class="fa fa-university"></i> Masteral Degree</h3>
                    <hr class="mt-2 mb-2">
                  </div>

                  {{-- body --}}
                  <div class="md-form">
                    <input placeholder="Your Course" type="text" class="form-control"  name="course" id="course" value="{{Request::old('course')}}" required="">
                    <label for="course">Course</label>
                  </div>
                  <div class="md-form">
                    <input placeholder="Your Major if any..." type="text" class="form-control"  name="major" id="major" value="{{Request::old('major')}}">
                    <label for="major">Major</label>
                  </div>
                  <div class="md-form">
                    <input placeholder="Write in full..." type="text" class="form-control"  name="school" id="school" value="{{Request::old('school')}}" required="">
                    <label for="school">School</label>
                  </div>
                  <div class="md-form">
                    <input placeholder="Your scholarship grant if any..." type="text" class="form-control"  name="scholarship" id="scholarship" value="{{Request::old('scholarship')}}">
                    <label for="scholarship">Scholarship</label>
                  </div>
                  <div class="md-form">
                    <input placeholder="Your award grant if any..." type="text" class="form-control"  name="award" id="award" value="{{Request::old('award')}}">
                    <label for="scholarship">Award</label>
                  </div>
                  <div class="form-inline">
                    <div class="md-form form-group">
                      <input placeholder="2017" type="number" class="form-control"  name="yearstarted" id="yearstarted" value="{{Request::old('yearstarted')}}" data-parsley-type="integer" data-parsley-min="4" required="">
                      <label for="yearstarted">Year Started</label>
                    </div>
                    <div class="md-form form-group">
                      <input type="checkbox" onclick="var input = document.getElementById('yeargraduated'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}" />
                      <input placeholder="Check if graduated" type="number" class="form-control" disabled="disabled"   name="yeargraduated" id="yeargraduated" value="{{Request::old('yeargraduated')}}" data-parsley-type = "integer" min="4">
                      <label for="yeargraduated">Year Graduated</label>
                    </div>
                  </div>
                  <hr>
                  <center>
                    <div class="md-form">
                      <button class="btn red" type="cancel" data-dismiss="modal" value="Cancel" > <i class="fa fa-times"></i> Cancel</button>
                      <button class="btn green" type="submit" name="button" value="submit"><i class="fa fa-floppy-o"></i> Save Changes</button>
                      {{-- <input type="hidden" name="_method" value="PUT"> --}}
                      <input type="hidden" name="educ_category_id" value="2">
                      <input type="hidden" name="faculty_id" value="{{$faculty-> id}}">
                      <input type="hidden" name="_token" value="{{Session::token()}}">
                    </div>
                  </center>
                </div>
              </form>
            </div>
          <!--/.Content-->
          </div>
        </div>
        <!--/. end masters Modal-->

        <!--Doc Modal-->
          <div class="modal fade" id="doc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <!--Content-->
              <div class="modal-content">
                <form class="form-group" action="{{route('educbackground.store', $faculty->id)}}" method="post">
                    <div class="card-block">
                      {{-- header --}}
                      <div class="text-xs-center">
                        <h3><i class="fa fa-university"></i> Doctoral Degree</h3>
                        <hr class="mt-2 mb-2">
                      </div>

                      {{-- body --}}
                      <div class="md-form">
                        <input placeholder="Your Course" type="text" class="form-control"  name="course" id="course" value="{{Request::old('course')}}" required="">
                        <label for="course">Course</label>
                      </div>
                      <div class="md-form">
                        <input placeholder="Your Major if any..." type="text" class="form-control"  name="major" id="major" value="{{Request::old('major')}}">
                        <label for="major">Major</label>
                      </div>
                      <div class="md-form">
                        <input placeholder="Write in full..." type="text" class="form-control"  name="school" id="school" value="{{Request::old('school')}}" required="">
                        <label for="school">School</label>
                      </div>
                      <div class="md-form">
                        <input placeholder="Your scholarship grant if any..." type="text" class="form-control"  name="scholarship" id="scholarship" value="{{Request::old('scholarship')}}">
                        <label for="scholarship">Scholarship</label>
                      </div>
                      <div class="md-form">
                        <input placeholder="Your award grant if any..." type="text" class="form-control"  name="award" id="award" value="{{Request::old('award')}}">
                        <label for="scholarship">Award</label>
                      </div>
                      <div class="form-inline">
                        <div class="md-form form-group">
                          <input placeholder="2017" type="number" class="form-control"  name="yearstarted" id="yearstarted" value="{{Request::old('yearstarted')}}" data-parsley-type="integer" data-parsley-min="4" required="">
                          <label for="yearstarted">Year Started</label>
                        </div>
                        <div class="md-form form-group">
                          <input type="checkbox" onclick="var input = document.getElementById('yeargraduated'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}" />
                          <input placeholder="Check if graduated" type="number" class="form-control" disabled="disabled"   name="yeargraduated" id="yeargraduated" value="{{Request::old('yeargraduated')}}" data-parsley-type = "integer" min="4">
                          <label for="yeargraduated">Year Graduated</label>
                        </div>
                      </div>
                      <hr>
                      <center>
                        <div class="md-form">
                          <button class="btn red" type="cancel" data-dismiss="modal" value="Cancel" > <i class="fa fa-times"></i> Cancel</button>
                          <button class="btn green" type="submit" name="button" value="submit"><i class="fa fa-floppy-o"></i> Save Changes</button>
                          {{-- <input type="hidden" name="_method" value="PUT"> --}}
                          <input type="hidden" name="educ_category_id" value="3">
                          <input type="hidden" name="faculty_id" value="{{$faculty-> id}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                        </div>
                      </center>
                    </div>
                  </form>
                </div>
              <!--/.Content-->
              </div>
            </div>
            <!--/. end Doc Modal-->
