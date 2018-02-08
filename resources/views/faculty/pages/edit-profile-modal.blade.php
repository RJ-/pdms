<!--profile Modal-->
    <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!--Content-->
        <div class="modal-content">
          <div class="card">
            <div class="card-block">
              {!! Form::model($faculty, ['route' => ['faculty.update', $faculty->id], 'data-parsley-validate' => '',
                'method' => 'PUT']) !!}
                <div class="text-xs-center">
                  <h3><i class="fa fa-user"></i> Manage Profile</h3>
                  <hr class="mt-2 mb-2">
                </div>

              <!--First row-->
                <div class="row">
                  <div class="col-md-6">
                    <div class="md-form">
                      {{ Form::label('surname', 'Surname')}}
                      {{ Form::text('surname', null, ['class' => 'form-control', 'id' => 'surname', 'required' => ''])}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="md-form">
                      {{ Form::label('firstname', 'First Name')}}
                      {{ Form::text('firstname', null, ['class' => 'form-control', 'id' => 'firstname', 'required' => ''])}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="md-form">
                      {{ Form::label('middlename', 'Middle Name')}}
                      {{ Form::text('middlename', null, ['class' => 'form-control', 'id' => 'middlename', 'required' => ''])}}
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="md-form">
                      {{ Form::label('birthdate', 'Birthdate')}}
                      {{ Form::text('birthdate', null, ['class' => 'form-control', 'id' => 'birthdate', 'required' => ''])}}
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form">
                          {{ Form::label('email', 'Email Address')}}
                          {{ Form::text('email', null, ['class' => 'form-control', 'data-parsley-type'=>'email', 'required' => '' ])}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <label for="form41" class="">College / Campus</label>
                        <div class="md-form">
                          {{ Form::select('college_id', $colleges, null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                      <label for="form41" class="">Field of Specialization</label>
                        <div class="md-form">
                          <select class="form-control select2-multi" name="fields[]" multiple="multiple" style="width: 35em;">
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
                    <div class="col-md-8">
                      <label for="form41" class="">Professional Development Needs</label>
                        <div class="md-form">
                          {{ Form::select('needs[]', $needs, null, ['class' => 'form-control select1-multi',
                                    'multiple' => 'multiple', 'style' => 'width: 35em']) }}
                        </div>
                    </div>
                </div>
                <!--/.First row-->
                <div class="row">
                  <center>
                    <div class="col-md-12">
                      <a href="">
                        <button type="button" name="button" class="btn red btn-lg" data-dismiss="modal"> <i class="fa fa-times"></i> Cancel</button>
                      </a>
                      <button class="btn green btn-lg submit" type="submit">
                          <i class="fa fa-floppy-o"></i> Save Profile
                      </button>
                      <input type="hidden" name="_token" value="{{Session::token()}}">
                    </div>
                  </center>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
          </div>
        <!--/.Content-->
        </div>
      </div>
<!--/. end profile Modal-->

<!--profile Modal-->
    <div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!--Content-->
        <div class="modal-content">
          <div class="card">
            <div class="card-block">
              {!! Form::model($faculty, ['url' => ['facultychangepassword'], 'data-parsley-validate' => '',
                'method' => 'POST']) !!}
                {{-- header --}}
                <div class="text-xs-center">
                  <h3><i class="fa fa-lock"></i> Change Password</h3>
                  <hr class="mt-2 mb-2">
                </div>
              <!--First row-->
                <div class="row">
                  <div class="col-md-12">
                    <div class="md-form">
                      {{ Form::label('oldpassword', 'Old Password')}}
                      {{ Form::password('oldpassword', null, ['class' => 'form-control', 'id' => 'password', 'required' => ''])}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="md-form">
                      {{ Form::label('password', 'New Password ')}}
                      {{ Form::password('password', null, ['class' => 'form-control', 'id' => 'password', 'min' => '6', 'required' => ''])}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="md-form">
                      {{ Form::label('confirmpassword', 'Confirm New Password')}}
                      {{ Form::password('confirmpassword', null, ['class' => 'form-control', 'id' => 'confirmpassword', 'required' => '',
                        'data-parsley-equalto'=>'#password'])}}
                    </div>
                  </div>
                </div>
                <!--/.First row-->
                <div class="row">
                  <br/>
                  <center>
                    <div class="col-md-12">
                      <a href="">
                        <button type="button" name="button" data-dismiss="modal" class="btn red btn-lg"> <i class="fa fa-times"></i> Cancel</button>
                      </a>
                      <button class="btn green btn-lg submit" type="submit">
                        <i class="fa fa-floppy-o"></i>  Save Changes
                      </button>
                      <input type="hidden" name="_token" value="{{Session::token()}}">
                    </div>
                  </center>
                </div>
                {!! Form::close() !!}
            </div>
          </div>
          </div>
        <!--/.Content-->
        </div>
      </div>
<!--/. end profile Modal-->
