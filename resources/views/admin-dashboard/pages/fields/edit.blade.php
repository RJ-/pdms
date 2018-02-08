@extends('layouts.adminMaster')

@section('title')
  Field | {{$fields->name}}
@endsection

@section('content')
  @section('header')
          <b> Edit Field Name | </b> <small>{{$fields->name}}</small>
  @endsection

  <div class="row">
        <div class="col-md-8">
          {{ Form::model($fields, ['route' => ['field.update', $fields->id], 'data-parsley-validate' => '', 'method' => "put"]) }}
              {{ Form::label('name', 'Field Name')}}
              {{ Form::text('name', null, ['class' => 'form-control', 'required' => ''])}}
              {{ Form::hidden('category_id', null, ['value' => $fields->category->id])}}
              {{ Form::button('<i class="fa fa-floppy-o"></i> Save Changes', ['class' => 'btn green pull-right btn-md save', 'type' => 'submit']) }}
          {{ Form::close() }}
              <a href="{{ route('field.show', $fields->id) }}">
              {{ Form::button('<i class="fa fa-eraser"></i> Cancel', ['class' => 'btn btn-warning btn-md pull-right cancel', 'onclick' => 'goBack()'])}}</a>
    </div>
  </div>
@endsection

@section('javascript')
  <script type="text/javascript">
      $(document).on("click", ".save", function(e) {
            confirm("Are you sure you want to save changes made?");
      });
  </script>
@endsection
