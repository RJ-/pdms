@extends('layouts.adminMaster')

@section('title')
  Training and Development Categories
@endsection

@section('stylesheets')
  <style media="screen">
    .badge-important { background-color: #d15b47!important }
  </style>
@endsection

@section('content')
  @section('header')
    <b>Training and Development Categories</b>
  @endsection

  <div class="row">
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-1">
          #
        </div>
        <div class="col-md-7">
          <b>Categories</b>
        </div>
        <div class="col-md-4">
          <b>Number of Faculty in Need</b>
        </div>
      </div>
      @foreach ($needs as $key => $need)
          <div class="row">
              <hr>
              <div class="col-md-1">
                {{$counter++}}
              </div>
              <div class="col-md-7">
                <a href="{{route('needs.show',$need->id)}}">{{$need -> name}}</a>
              </div>
              <div class="col-md-2">
                  <span class="badge badge-important pull-right">{{$need->faculty()->count()}}</span>
              </div>
          </div>
      @endforeach
    </div>

    <div class="col-md-4">
      <div class="well">
        <h3><b>Create New Training and Development Categories</b></h3>
        {!! Form::model(['route' => 'needs.store', 'method' => 'POST']) !!}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter New Training Needs Category'])}}
              {!! Form::button('<i class="fa fa-eraser"></i> Reset', ['class' => 'btn orange btn-md', 'type' => 'reset']) !!}
              {!! Form::button('<i class="fa fa-plus"></i> Create Category', ['class' => 'btn green btn-md create', 'type' => 'submit']) !!}
        {!! Form::close() !!}
        <br>
      </div>
    </div>
  </div>

@endsection

@section('javascript')
  <script type="text/javascript">
      $(document).on("click", ".create", function(e) {
          if (confirm("Are you sure you want to create a new needs category?")) {
          }else {
            e.preventDefault();
          }
      });
  </script>
@endsection
