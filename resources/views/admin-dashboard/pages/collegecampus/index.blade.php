@extends('layouts.adminMaster')

@section('title')
  College/Campus
@endsection

@section('content')
  @section('header')
    <b>College/Campus</b>
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
      @foreach ($colleges as $college)
      <div class="row">
          <hr>
          <div class="col-md-1">
            {{$counter++}}
          </div>
          <div class="col-md-7">
            <a href="{{route('campus-college.show',$college->id)}}">{{$college -> name}}</a>
          </div>
      </div>
      @endforeach
    </div>

    <div class="col-md-4">
      <div class="well">
        <h3>Create New College/Campus</h3>
        {!! Form::open(['route' => 'campus-college.store', 'method' => 'POST']) !!}
          <div class="md-form">
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter New College/Campus'])}}

            {!! Form::button('<i class="fa fa-eraser"></i> Reset', ['class' => 'btn orange btn-md', 'type' => 'reset']) !!}
            {!! Form::button('<i class="fa fa-plus"></i> Create College/Campus', ['class' => 'btn green btn-md create', 'type' => 'submit']) !!}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

@endsection

@section('javascript')
  <script type="text/javascript">
      $(document).on("click", ".create", function(e) {
        if (confirm("Are you sure you want to create a new college/campus?")) {
        }else{
          e.preventDefault();
        }
      });
  </script>
@endsection
