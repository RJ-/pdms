@extends('layouts.adminMaster')

@section('title')
  Categories
@endsection

@section('content')
  @section('header')
    <b>Categories</b>
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
      @foreach ($categories as $category)
      <div class="row">
          <hr>
          <div class="col-md-1">
            {{$counter++}}
          </div>
          <div class="col-md-7">
            <a id="popoverData" href="#"
            data-content="
              @foreach ($category->field as $field)
                <ul>
                <li><a href={{route('field.show',$field->id)}}>{{$field -> name}}</a></li>
              </ul>
              @endforeach
              <hr>
              <a href={{route('category.show',$category->id)}}><i class='fa fa-plus'> </i> Add Related Fields</a>"
            rel="popover" data-placement="right" data-original-title="Related Fields"
            data-trigger="focus" data-toggle="popover">
              {{$category -> name}}</a>
          </div>

      </div>
      @endforeach
    </div>

    <div class="col-md-4">
      <div class="well">
        <h3><b>Create New Category</b></h3>
        {!! Form::model(['route' => 'category.store', 'method' => 'POST']) !!}
          <div class="md-form">
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter New Category'])}}

            {!! Form::button('<i class="fa fa-eraser"></i> Reset', ['class' => 'btn orange btn-md', 'type' => 'reset']) !!}
            {!! Form::button('<i class="fa fa-plus"></i> Create Category', ['class' => 'btn green btn-md create', 'type' => 'submit']) !!}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection

@section('javascript')
  <script type="text/javascript">
      $(document).on("click", ".create", function(e) {
            if(confirm("Are you sure you want to create a new category?")){

            }else {
              e.preventDefault();
            }
      });
  </script>
  <script type="text/javascript">
  $('[data-toggle="popover"]').popover({html:true});
  </script>
@endsection
