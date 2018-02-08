@extends('layouts.adminMaster')

@section('title')
  College/Campus | {{$college->name}}
@endsection

@section('stylesheets')

  <!-- Tags CSS -->
  <link href="{{ asset('css/select2.min.css')}}" rel="stylesheet">

@endsection

@section('content')
  @section('header')
          <b> Edit College/Campus | </b> <small>{{$college->name}}</small>
  @endsection

  <div class="row">
        <div class="col-md-8">
          {{ Form::model($college, ['route' => ['campus-college.update', $college->id], 'data-parsley-validate' => '', 'method' => "put"]) }}
              {{ Form::label('name', 'College/Campus Name')}}
              {{ Form::text('name', null, ['class' => 'form-control', 'required' => ''])}}
              <h5 class="page-header"><b>College Dean</b></h5>
              <div class="md-form">
                  <select class="form-control select2-multi" name="dean[]">
                        @foreach ($deans as $dean)
                          <option value="{{$dean->id}}">{{$dean->surname}}, {{$dean->firstname}}</option>
                        @endforeach
                  </select>
              </div>
              {{ Form::button('<i class="fa fa-floppy-o"></i> Save Changes', ['class' => 'btn green pull-right btn-md', 'type' => 'submit']) }}
          {{ Form::close() }}
          {{ Form::button('<i class="fa fa-eraser"></i> Cancel', ['class' => 'btn orange btn-md pull-right cancel', 'onclick' => 'goBack()'])}}</a>
        </div>
  </div>

  <div class="row">
    <div class="col-md-4">

    </div>
  </div>

@endsection

@section('javascript')
  <!-- Tags JavaScript -->
  <script src="{{asset('js/select2.min.js')}}"></script>

  <script type="text/javascript">
    $('.select2-multi').select2();
  </script>
@endsection
