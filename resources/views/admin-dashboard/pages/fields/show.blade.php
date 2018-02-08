@extends('layouts.adminMaster')

@section('title')
  Field | {{$fields->name}}
@endsection

@section('content')
  @section('header')
  <div class="row">
      <div class="col-md-12">
        <div class="col-md-8">
          <b><a href="{{route('category.index')}}">{{$fields->name}}</a> | </b> <small>{{$fields->activity()->count()}} Related Activity</small>
        </div>
        <div class="col-md-2">
          {!! Form::open(['route' => ['field.destroy', $fields->id], 'method' => 'DELETE']) !!}
              {!! Form::button('<i class="fa fa-times"></i> Remove', ['class' => 'btn red btn-block delete', 'type' => 'submit']) !!}
          {!! Form::close() !!}
        </div>
        <div class="col-md-2">
          <a href="{{route('field.edit',$fields->id)}}" class="btn blue btn-block"><i class="fa fa-edit"></i> Edit Field</a>
        </div>
      </div>
  </div>
  @endsection

  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-1">
          #
        </div>
        <div class="col-md-5">
          Title of Activity
        </div>
        <div class="col-md-6">
          Related Fields
        </div>
      </div>
      @foreach ($fields->activity as $activity)
      <div class="row">
          <hr>
          <div class="col-md-1">
            {{$counter++}}
          </div>
          <div class="col-md-5">
            {{$activity -> title}}
          </div>
          <div class="col-md-5">
            @foreach ($activity->field as $fields)
              <span class="label label-default">{{$fields->name}}</span>
            @endforeach
          </div>
          <div class="col-md-1">
            <a href="{{route('pdactivity.show', $activity->id)}}"
              class="btn btn-default btn-sm" style="margin-top:0px;">View</a>
          </div>
      </div>
      @endforeach
    </div>

@endsection
@section('javascript')
  <script type="text/javascript">
      $(document).on("click", ".delete", function(e) {
            confirm("Are you sure you want to delete this Field?");
      });
  </script>
@endsection
