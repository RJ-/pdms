<!--profile Modal-->
    <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!--Content-->
        <div class="modal-content">
          <div class="card">
            <div class="card-block">
              {!! Form::model($admin, ['route' => ['HrdProfileUpdate', $admin->id],
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
                          {{ Form::text('username', null, ['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                          {{ Form::label('email', 'Email Address')}}
                          {{ Form::text('email', null, ['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>
              <!--First row-->
                <div class="row">
                  <div class="col-md-12">
                    <div class="md-form">
                      {{ Form::label('surname', 'Surname')}}
                      {{ Form::text('surname', null, ['class' => 'form-control', 'id' => 'surname'])}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="md-form">
                      {{ Form::label('firstname', 'First Name')}}
                      {{ Form::text('firstname', null, ['class' => 'form-control', 'id' => 'firstname'])}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="md-form">
                      {{ Form::label('middlename', 'Middle Name')}}
                      {{ Form::text('middlename', null, ['class' => 'form-control', 'id' => 'middlename'])}}
                    </div>
                  </div>
                </div>
                <!--/.First row-->
                <div class="row">
                  <br/>
                  <center>
                    <div class="col-md-12">
                      <a href="">
                        <button type="button" name="button" class="btn btn-danger btn-lg">Cancel</button>
                      </a>
                      <button class="btn btn-success btn-lg submit" type="submit">
                          Save Profile
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
              <form class="" action="{{url('hrdchangepassword')}}" method="post">
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
                      {{ Form::password('oldpassword', null, ['class' => 'form-control', 'id' => 'password'])}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="md-form">
                      {{ Form::label('password', 'New Password ')}}
                      {{ Form::password('password', null, ['class' => 'form-control', 'id' => 'password'])}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="md-form">
                      {{ Form::label('confirmpassword', 'Confirm New Password')}}
                      {{ Form::password('confirmpassword', null, ['class' => 'form-control', 'id' => 'confirmpassword'])}}
                    </div>
                  </div>
                </div>
                <!--/.First row-->
                <div class="row">
                  <br/>
                  <center>
                    <div class="col-md-12">
                      <a href="">
                        <button type="button" name="button" class="btn btn-danger btn-lg">Cancel</button>
                      </a>
                      <button class="btn btn-success btn-lg submit" type="submit">
                          Save Changes
                      </button>
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
