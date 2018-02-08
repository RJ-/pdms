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
        <div class="col-md-8">
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
                <th> <i class="fa fa-map-marker prefix"></i> Where:</th>
                <td>{{$activity->venue}}</td>
              </tr>
              <tr>
                <th> <i class="fa fa-calendar prefix"></i> When:</th>
                <td>
                  {{date('M j, Y', strtotime($activity -> dateFrom))}} - {{date('M j, Y', strtotime($activity -> dateTo))}}
                </td>
              </tr>
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
        <div class="col-md-4">
          @if ($activity->activity_status == 0)
            <div class="card">
              <h6 class="card-header  white-text">Interested/Recommended Participants</h6>
              <table class="table">
                @foreach ($faculty as $faculty)
                  <tr>
                    <td> <i class="fa fa-user prefix"></i> <b>{{$faculty->surname}}, {{$faculty->firstname}}</b> -
                      <i>{{$faculty->college->abbrv}}</i></td>
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
    </div>

  {{-- <div class="streak">
    <div class="flex-center">
      <ul>
        <li><h2 class="h2-responsive wow fadeIn">Hellow World</h2></li>
      </ul>
    </div>
  </div> --}}
@endsection
