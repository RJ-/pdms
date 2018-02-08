@extends('layouts.activity')

@section('title')
    PD Activity
@endsection

@section('content')
<style media="screen">
.view {
@if ($activity->training_needs_id != NULL)
  background-color: #4285f4;
  @else
  background-color: #ffbb33;
@endif
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

@if ($activity->training_needs_id != NULL)
  .card-header{
    background-color: #4285f4;
  }
  @else
  .card-header{
    background-color: #ffbb33;
  }
@endif


.flex-center {
    color: #fff;
    align-items:flex-end;
}
</style>
<div class="view">
    <!--Intro content-->
    <div class="full-bg-img flex-center"><br>
        <ul>
            <li>
                <h1 class="h1-responsive wow fadeInDown">{{$activity->title}}</h1>
            </li>

        </ul>
    </div>
</div>
    <div class="container">
      <br>
      <div class="row">
        <div class="col-md-7">
          <div class="card">
            <h6 class="card-header  white-text">Description</h6>
            <div class="card-block">
              <p class="card-text">
                {!!$activity->details!!}
              </p>
            </div>
          </div>

          <div class="card">
            <h6 class="card-header  white-text">Details</h6>
            <table class="table">
              <tr>
                <th> <i class="fa fa-building prefix"></i> Sponsor:</th>
                <td>{{$activity->sponsor}}</td>
              </tr>
              <tr>
                <th> <i class="fa fa-map-marker prefix"></i> Where:</th>
                <td>{{$activity->venue}}</td>
              </tr>
              <tr>
                <th> <i class="fa fa-calendar prefix"></i> When:</th>
                <td>
                  {{date('M j, Y', strtotime($activity -> dateFrom))}} - {{date('M j, Y', strtotime($activity -> dateTo))}}
                </td>
              </tr>
              @if ($activity->field->count() != NULL)
              <tr>
                <th> <i class="fa fa-pin prefix"></i> Tags:</th>
                <td>
                    @foreach ($activity->field as $field)
                      <a href="#"><span class="tag tag-warning">{{$field->name}}</span></a>
                    @endforeach

                </td>
              </tr>
              @endif
              <tr>
                <th> <i class="fa fa-thumb-tack prefix"></i> Faculty:</th>
                <td><b>{{$activity->faculty->count()}}</b> faculty
                  @if ($activity->faculty->count() == 1)
                    was
                  @else
                    were
                  @endif
                  recommended</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-5">
          @php
            $counter = 0;
          @endphp
          @if ($activity->activity_status == 0)
            <div class="card">
              <h6 class="card-header  white-text">
                @if ($activity->training_needs_id != NULL)
                  Interested Participants
                  @else
                    Recommended Participants
                @endif
              </h6>
              <table class="table">
                @foreach ($faculty as $key => $faculty)
                  <tr>
                    <td> <i class="fa fa-user prefix"></i> <b>{{$faculty->surname}}, {{$faculty->firstname}}</b> -
                      <i>{{$faculty->college->abbrv}}</i></td>
                    <td>
                      @if ($response[$key] == NULL)
                        <em class="text-primary">(Pending)</em>
                      @elseif($response[$key] == 1)
                        <em class="text-success">(Accepted)</em>
                        @php
                          $counter = 1;
                        @endphp
                      @elseif($response[$key] == 2)
                        <em class="text-warning">(Declined)</em>
                        @php
                          $counter = 2;
                        @endphp
                      @endif
                    </td>
                  </tr>
                @endforeach
              </table>
            </div>
          @else
            <div class="card">
              <h6 class="card-header white-text">Recommended Participants</h6>
              <table class="table">
                  <tr>
                    <td>
                      <b>Application has ended.</b>
                    </td>
                  </tr>
              </table>
            </div>
          @endif
          <div class="card">
            <h6 class="card-header  white-text">Approved Participants</h6>
            <table class="table">
              @if ($confirmed == NULL)
                <tr>
                  <td><em>There are no apporved participants at this moment.</em></td>
                </tr>
              @endif
              @foreach ($confirmed as $faculty)
                <tr>
                  <td> <i class="fa fa-user prefix"></i> <b>{{$faculty->surname}}, {{$faculty->firstname}}</b> -
                    <i>{{$faculty->college->abbrv}}</i>
                  </td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
      <div class="row">
          @if ($activity->training_needs_id != NULL)
            <div class="row">
              <div class="col-md-12" style="text-align:center">
                <a>
                  <form class="" action="{{route('joinActivity')}}" method="post">
                      <input type="hidden" name="p_dactivity_id" value="{{$activity->id}}">
                      <input type="hidden" name="faculty_id" value="{{Auth::id()}}">
                      <input type="hidden" name="_token" value="{{Session::token()}}">
                      <button class="btn green btn-lg" type="submit" name="button">
                        <i class="fa fa-bookmark left"></i> Apply
                      </button>
                  </form>
                </a>
              </div>
            </div>
            @else
              @if ($faculty_hit == TRUE)
                    @if ($activity->activity_status == 0 && $isset == FALSE)
                      <div class="row">
                        <div class="col-md-6">
                          <a>
                            {!! Form::model($activity, ['route' => ['declineActivity', $activity->id], 'data-parsley-validate' => '',
                              'method' => 'PUT'])!!}
                                <input type="hidden" name="p_dactivity_id" value="{{$activity->id}}">
                                <input type="hidden" name="faculty_id" value="{{Auth::id()}}">
                                <input type="hidden" name="faculty_response" value="2">
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                                <button class="btn red btn-lg pull-right border-color: red;" type="submit" name="button">
                                  <i class="fa fa-times left"></i> Decline
                                </button>
                            {!! Form::close() !!}
                          </a>
                        </div>
                        <div class="col-md-6">
                          <a>
                            {!! Form::model($activity, ['route' => ['acceptActivity', $activity->id], 'data-parsley-validate' => '',
                              'method' => 'PUT'])!!}
                                <input type="hidden" name="p_dactivity_id" value="{{$activity->id}}">
                                <input type="hidden" name="faculty_id" value="{{Auth::id()}}">
                                <input type="hidden" name="faculty_response" value="1">
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                                <button class="btn green btn-lg pull-left" type="submit" name="button">
                                  <i class="fa fa-check-circle left"></i> Accept
                                </button>
                            {!! Form::close() !!}
                          </a>
                        </div>
                      </div>
                    @elseif ($counter == 1)
                      <div class="row">
                        <div class="col-md-7">
                          <a>
                            {!! Form::model($activity, ['route' => ['declineActivity', $activity->id], 'data-parsley-validate' => '',
                              'method' => 'PUT'])!!}
                                <input type="hidden" name="p_dactivity_id" value="{{$activity->id}}">
                                <input type="hidden" name="faculty_id" value="{{Auth::id()}}">
                                <input type="hidden" name="faculty_response" value="2">
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                                <button class="btn red btn-lg pull-right" type="submit" name="button">
                                  <i class="fa fa-times left"></i> Decline
                                </button>
                            {!! Form::close() !!}
                          </a>
                        </div>
                      </div>
                    @elseif ($counter == 2)
                      <div class="row">
                        <div class="col-md-7">
                          <a >
                            {!! Form::model($activity, ['route' => ['acceptActivity', $activity->id], 'data-parsley-validate' => '',
                              'method' => 'PUT'])!!}
                                <input type="hidden" name="p_dactivity_id" value="{{$activity->id}}">
                                <input type="hidden" name="faculty_id" value="{{Auth::id()}}">
                                <input type="hidden" name="faculty_response" value="1">
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                                <button class="btn green btn-lg pull-right" type="submit" name="button">
                                  <i class="fa fa-check-circle right"></i> Accept
                                </button>
                            {!! Form::close() !!}
                          </a>
                        </div>
                      </div>
                    @endif
                @endif
              @endif
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
