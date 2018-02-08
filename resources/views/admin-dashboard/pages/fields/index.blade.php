@extends('layouts.adminMaster')

@section('title')
  Fields
@endsection

@section('content')
  @section('header')
    <b>Fields</b>
  @endsection

  <div class="row">
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-1">
          #
        </div>
        <div class="col-md-7">
          Name
        </div>
      </div>
      @foreach ($fields as $field)
      <div class="row">
          <hr>
          <div class="col-md-1">
            {{$counter++}}
          </div>
          <div class="col-md-7">
            <a href="{{route('field.show',$field->id)}}">{{$field -> name}}</a>
          </div>
      </div>
      @endforeach
    </div>

    <div class="col-md-4">
      <div class="well">
        <h3>Create New Field</h3>
        {!! Form::open(['route' => 'field.store', 'method' => 'POST']) !!}
          <div class="md-form">
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter New Field'])}}

            {!! Form::submit('Reset', ['class' => 'btn btn-danger btn-sm', 'type' => 'reset']) !!}
            {!! Form::submit('Create New Field', ['class' => 'btn btn-success btn-sm', 'type' => 'button']) !!}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

@endsection
