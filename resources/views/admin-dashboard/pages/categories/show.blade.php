@extends('layouts.adminMaster')

@section('title')
  Category | {{$categories->name}}
@endsection

@section('content')
  @section('header')
  <div class="row">
      <div class="col-md-12">
        <div class="col-md-8">
          <b><a href="{{route('category.index')}}">{{$categories->name}}</a> | </b> <small>{{$categories->field()->count()}} Related Fields</small>
        </div>
        @if ($categories->field()->count()==0)
          <div class="col-md-2">
            {!! Form::model(['route' => ['category.destroy', $categories->id], 'method' => 'DELETE']) !!}
                {!! Form::button('<i class="fa fa-times"></i> Remove', ['class' => 'btn red btn-block delete', 'type' => 'submit']) !!}
            {!! Form::close() !!}
          </div>
        @endif
        <div class="col-md-2">
          <a href="{{route('category.edit',$categories->id)}}" class="btn blue btn-block"> <i class="fa fa-edit"></i> Edit Category</a>
        </div>
      </div>
  </div>
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
      @foreach ($categories->field as $field)
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
        <h3>Add New Field</h3>
        {!! Form::open(['route' => 'field.store', 'method' => 'POST']) !!}
          <div class="md-form">
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter New Field'])}}
            {{ Form::hidden('category_id', $categories->id, ['class' => 'form-control'])}}
            {{ Form::button('<i class="fa fa-eraser"></i> Reset', ['class' => 'btn orange btn-md cancel', 'type' => 'reset']) }}
            {!! Form::button('<i class="fa fa-plus"></i> Create Field', ['class' => 'btn green btn-md create', 'type' => 'submit']) !!}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

@endsection


@section('javascript')
  <script type="text/javascript">
      $(document).on("click", ".create", function(e) {
            if (confirm("Are you sure you want to create a new field?")) {
            }else {
              e.preventDefault();
            }
      });
  </script>
@endsection
