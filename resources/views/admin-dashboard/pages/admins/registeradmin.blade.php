@extends('layouts.adminMaster')

@section('title')
  Register Administrator
@endsection

@section('header')
  <b>Register Administrator</b>
@endsection
@section('content')
  <div class="row">
    <div class="col-md-offset-3">
    <form class="" action="{{route('administrators.store')}}" method="post">
    <!--Personal info row-->
    <div class="row">
      <div class="col-md-8">
        <label for="form41" class="">Designation</label>
        <div class="md-form">
            <select class="form-control" name="designation">
                <option value="president">University President</option>
                <option value="vpaa">Vice-President for Academic Affairs</option>
                <option value="hrd">Human Resource Development Director</option>
            </select>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="md-form">
                <input type="text" id="form41" class="form-control" name="username" required="">
                <label for="form41" class="">Username</label>
            </div>
        </div>

        <div class="col-md-4">
            <div class="md-form">
                <input type="text" id="form41" class="form-control" name="password" value="{{str_random(6)}}" required="">
                <label for="form41" class="">Password</label>
            </div>
        </div>
    </div>
      <div class="row">
          <div class="col-md-8">
              <div class="md-form">
                  <input type="text" id="form41" class="form-control" name="surname" required="">
                  <label for="form41" class="">Surname</label>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-8">
              <div class="md-form">
                  <input type="text" id="form41" class="form-control" name="firstname" required="">
                  <label for="form41" class="">First Name</label>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-8">
              <div class="md-form">
                  <input type="text" id="form41" class="form-control" name="middlename" required="">
                  <label for="form41" class="">Middle Name</label>
              </div>
          </div>
      </div>
      <div class="row">
        <div class="col-md-8">
        <center>
          <button class="btn btn-warning btn-lg" type="button" onclick="goBack()">
              <i class="fa fa-eraser"></i> Cancel
          </button>
        <button class="btn green btn-lg" type="submit" name="button" value="Submit">
            <i class="fa fa-floppy-o"></i> Register Administrator
        </button>
      </center>
        <input type="hidden" name="_token" value="{{Session::token()}}">
      </div>
      </div>
    </form>
      <!--/.Personal info row-->
    </div><!--/.offset-->
  </div><!--/.row-->
@endsection
