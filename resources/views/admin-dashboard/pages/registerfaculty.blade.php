@extends('layouts.adminMaster')

@section('title')
  Register Faculty
@endsection

@section('content')
  @section('header')
    <b>Register Faculty</b>
  @endsection

  <div class="row">
    <div class="col-md-offset-3">
    <form class="" action="{{route('saveFaculty')}}" method="post" data-parsley-validate="">
    <!--Personal info row-->
    <div class="row">
        <div class="col-md-4">
            <div class="md-form">
                <input type="text" id="form41" class="form-control" name="employee_id" required = "">
                <label for="form41" class="">Employee ID Number</label>
            </div>
        </div>

        <div class="col-md-4">
            <div class="md-form">
                <input type="text" id="form41" class="form-control" name="password" value="{{str_random(6)}}" required = "">
                <label for="form41" class="">Random Generated Password</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="md-form">
                <input type="email" id="form41" class="form-control" name="email" required = "">
                <label for="form41" class="">Email Address</label>
            </div>
        </div>
    </div>
      <div class="row">
          <div class="col-md-8">
              <div class="md-form">
                  <input type="text" id="form41" class="form-control" name="surname" required = "">
                  <label for="form41" class="">Surname</label>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-8">
              <div class="md-form">
                  <input type="text" id="form41" class="form-control" name="firstname" required = "">
                  <label for="form41" class="">First Name</label>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-8">
              <div class="md-form">
                  <input type="text" id="form41" class="form-control" name="middlename">
                  <label for="form41" class="">Middle Name</label>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-8">
            <label for="form41" class="">Academic Rank</label>
            <div class="md-form">
              <select class="form-control" name="acadrank_id">
                @foreach ($acadrank as $rank)
                  <option value="{{$rank->id}}">{{$rank->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <label for="form41" class="">College / Campus</label>
          <div class="md-form">
              <select class="form-control" name="college_id">
                @foreach ($colleges as $college)
                  <option value="{{$college->id}}">{{$college->name}}</option>
                @endforeach
              </select>
          </div>
        </div>
      </div>
      <div class="row">
        <center>
          <div class="col-md-8">
            <button class="btn btn-warning btn-lg" type="button" onclick="goBack()">
                <i class="fa fa-eraser"></i> Cancel
            </button>
          <button class="btn green btn-lg" type="submit" name="button" value="Submit">
              <i class="fa fa-floppy-o"></i> Register Faculty
          </button>
          <input type="hidden" name="_token" value="{{Session::token()}}">
        </div>
      </center>
      </div>
    </form>
      <!--/.Personal info row-->
    </div><!--/.offset-->
  </div><!--/.row-->
@endsection
