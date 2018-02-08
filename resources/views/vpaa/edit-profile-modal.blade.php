<!--profile Modal-->
    <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!--Content-->
        <div class="modal-content">
          <div class="card">
            <div class="card-block">
              {!! Form::model($admin, ['route' => ['VpaaProfileUpdate', $admin->id], 'data-parsley-validate' => '',
                'method' => 'PUT']) !!}
                {{-- header --}}
                <div class="text-xs-center">
                  <h3><i class="fa fa-user"></i> Profile Details</h3>
                  <hr class="mt-2 mb-2">
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                          {{ Form::label('username', 'Username')}}
                          {{ Form::text('username', null, ['class' => 'form-control', 'required' => ''])}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                          {{ Form::label('email', 'Email Address')}}
                          {{ Form::email('email', null, ['class' => 'form-control', 'required' => ''])}}
                        </div>
                    </div>
                </div>
              <!--First row-->
                <div class="row">
                  <div class="col-md-12">
                    <div class="md-form">
                      {{ Form::label('surname', 'Surname')}}
                      {{ Form::text('surname', null, ['class' => 'form-control', 'id' => 'surname', 'required' => ''])}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="md-form">
                      {{ Form::label('firstname', 'First Name')}}
                      {{ Form::text('firstname', null, ['class' => 'form-control', 'id' => 'firstname', 'required' => ''])}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="md-form">
                      {{ Form::label('middlename', 'Middle Name')}}
                      {{ Form::text('middlename', null, ['class' => 'form-control', 'id' => 'middlename', 'required' => ''])}}
                    </div>
                  </div>
                </div>
                <!--/.First row-->
                <div class="row">
                  <br/>
                  <center>
                    <div class="col-md-12">
                      <button class="btn red" type="cancel" data-dismiss="modal" value="Cancel" > <i class="fa fa-times"></i> Cancel</button>
                      <button class="btn green" type="submit" name="button" value="submit"><i class="fa fa-floppy-o"></i> Save Changes</button>
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
              <form class="" action="{{url('vpaachangepassword')}}" method="post" data-parsley-validate="">
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
                      {{ Form::password('password', null, ['class' => 'form-control', 'id' => 'password', 'required' => '', 'min' => '6'])}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="md-form">
                      {{ Form::label('confirmpassword', 'Confirm New Password')}}
                      {{ Form::password('confirmpassword', null, ['class' => 'form-control', 'id' => 'confirmpassword', 'required' => ''])}}
                    </div>
                  </div>
                </div>
                <!--/.First row-->
                <div class="row">
                  <br/>
                  <center>
                    <div class="col-md-12">
                      <button class="btn red" type="cancel" data-dismiss="modal" value="Cancel" > <i class="fa fa-times"></i> Cancel</button>
                      <button class="btn green" type="submit" name="button" value="submit"><i class="fa fa-floppy-o"></i> Save Changes</button>
                      <input type="hidden" name="_token" value="{{Session::token()}}">
                    </div>
                  </center>
                </div>
              </form>
            </div>
          </div>
          </div>
        <!--/.Content-->
        </div>
      </div>
<!--/. end profile Modal-->
