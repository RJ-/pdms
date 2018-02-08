@extends('layouts.adminMaster')

@section('title')
  Category | {{$category->name}}
@endsection

@section('content')
  @section('header')
          <b> Edit Category Name | </b> <small>{{$category->name}}</small>
  @endsection

  <div class="row">
        <div class="col-md-8">
          {{ Form::model($category, ['route' => ['category.update', $category->id], 'data-parsley-validate' => '', 'method' => "put"]) }}
              {{ Form::label('name', 'Category Name')}}
              {{ Form::text('name', null, ['class' => 'form-control', 'required' => ''])}}

              {{ Form::button('<i class="fa fa-floppy-o"></i> Save Changes', ['class' => 'btn green pull-right btn-md save']) }}
          {{ Form::close() }}
          <a href="{{ route('category.show', $category->id) }}">
          {{ Form::button('<i class="fa fa-eraser"></i> Cancel', ['class' => 'btn orange pull-right btn-md cancel'])}}</a>
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
