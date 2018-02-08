@extends('layouts.adminMaster')

@section('title')
  Edit Administrator
@endsection

@section('content')
  @section('header')
    <b>Edit Administrator Details</b>
  @endsection

  <div class="row">
    <div class="col-md-offset-3">
    {!! Form::model($admin, ['route' => ['administrators.update', $admin->id], 'data-parsley-validate' => '', 'method' => 'PUT'])!!}
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
              {{ Form::label('username', 'Username')}}
              {{ Form::text('username', null, ['class' => 'form-control', 'required' => ''])}}
            </div>
        </div>
    </div>
      <div class="row">
          <div class="col-md-8">
              <div class="md-form">
                {{ Form::label('surname', 'Surname')}}
                {{ Form::text('surname', null, ['class' => 'form-control', 'required' => ''])}}
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-8">
              <div class="md-form">
                {{ Form::label('firstname', 'First Name')}}
                {{ Form::text('firstname', null, ['class' => 'form-control', 'required' => ''])}}
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-8">
              <div class="md-form">
                {{ Form::label('middlename', 'Middle Name')}}
                {{ Form::text('middlename', null, ['class' => 'form-control', 'required' => ''])}}
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-8">
              <div class="md-form">
                {{ Form::label('email', 'Email Address')}}
                {{ Form::text('email', null, ['class' => 'form-control', 'required' => ''])}}
              </div>
          </div>
      </div>

      <div class="row">
        <br/>
        <center>
        <div class="col-md-8">
          {{ Form::button('<i class="fa fa-eraser"></i> Cancel', ['class' => 'btn btn-warning btn-lg cancel', 'onclick' => 'goBack()'])}}
          <button class="btn green btn-lg save" type="submit" name="button" value="Submit">
              <i class="fa fa-floppy-o"></i> Save Changes
          </button>
        <input type="hidden" name="_token" value="{{Session::token()}}">
        {!! Form::close() !!}
      </div>
      </div>
      <!--/.Personal info row-->
    </div><!--/.offset-->
  </div><!--/.row-->
@endsection
