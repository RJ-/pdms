@extends('layouts.vpaa-activity')

@section('title')
    PD Activity
@endsection

@section('stylesheets')

  <!-- Dashboard style -->
  <link href="{{ asset('css/multi-select.css') }}" rel="stylesheet" type="text/css" >

@endsection

@section('content')
<style media="screen">
.view {
    background-color: #ffbb33;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.flex {
    color: #fff;
    align-items:flex-end;
}
</style>
<div class="view">
    <!--Intro content-->
    <div class="full-bg-img flex-center"><br>
        <ul>
            <li>
                <h1 class="h1-responsive wow fadeIn">{{$activity->title}}</h1>
            </li>
        </ul>
    </div>
</div>

    <div class="container">
      <div class="row">
        <br/>
        <div class="col-md-12">
          <!--Panel-->
          <div class="card">
              <h6 class="card-header view white-text">Faculty Recommendation</h6>
              <div class="card-block">
                {!! Form::model($activity, ['route' => ['vpaa.update', $activity->id],
                  'method' => 'PUT'])!!}
                  <div class="md-form">
                    <select id='keep-order' multiple='multiple' name="faculty_id[]">
                      <optgroup label="Field of Specialization">
                        @foreach ($faculty as $faculty)
                          <option value="{{$faculty->id}}">{{$faculty->surname}}, {{$faculty->firstname}}</option>
                        @endforeach
                      </optgroup>
                      <optgroup label="Training Needs">
                        @foreach ($f_needs as $f_needs)
                          <option value="{{$f_needs->id}}">{{$f_needs->surname}}, {{$f_needs->firstname}}</option>
                        @endforeach
                      </optgroup>
                    </select>
                    <center>
                      <button class="btn btn-success btn-md submit" type="submit">
                        <i class="fa fa-book left"></i>Recommend
                      </button>
                      <a>
                      </a>
                    </center>
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                  </div>
                {!! Form::close() !!}
              </div>
          </div>
          <!--/.Panel-->
        </div>
      </div>
    </div>
  {{-- <div class="streak">
    <div class="flex-center">
      <ul>
        <li><h2 class="h2-responsive wow fadeIn">Hellow World</h2></li>
      </ul>
    </div>
  </div> --}}
@endsection

@section('javascript')
  <!-- JQuery -->
  <script type="text/javascript" src="{{ asset('js/jquery.multi-select.js') }}"></script>

  <script type="text/javascript">
  // run callbacks
  $('#keep-order').multiSelect({ keepOrder: true });
  </script>

@endsection
