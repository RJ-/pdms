@extends('layouts.adminMaster')

@section('title')
  Training Needs | {{$needs->name}}
@endsection

@section('content')
  @section('header')
          <b> Edit Training Needs Title | </b> <small>{{$needs->name}}</small>
  @endsection

  <div class="row">
        <div class="col-md-8">
          {{ Form::model($needs, ['route' => ['needs.update', $needs->id], 'data-parsley-validate'=> '', 'method' => 'PUT']) }}
              {{ Form::label('name', 'Training Needs Name')}}
              {{ Form::text('name', null, ['class' => 'form-control', 'required' => ''])}}
              {{ Form::button('<i class="fa fa-floppy-o"></i> Save Changes', ['class' => 'btn  green pull-right btn-md', 'type' => 'submit']) }}
          {{ Form::close() }}
          {{ Form::button('<i class="fa fa-eraser"></i> Cancel', ['class' => 'btn btn-warning pull-right btn-md cancel', 'onclick' => "goBack()"])}}

          {!! Form::model($needs, ['route' => ['needs.destroy', $needs->id], 'method' => 'DELETE']) !!}
              {!! Form::button('<i class="fa fa-times"></i> Delete Category', ['class' => 'btn red pull-left btn-md delete', 'type' => 'submit']) !!}
          {!! Form::close() !!}
        </div>
  </div>
@endsection


@section('javascript')
  <script type="text/javascript">
      $(document).on("click", ".delete", function(e) {
          if (confirm("Are you sure you want to delete category?")) {
          }else {
            e.preventDefault();
          }
      });
  </script>
@endsection
