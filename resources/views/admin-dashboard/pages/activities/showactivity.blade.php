@extends('layouts.adminMaster')

@section('title')
  Activity: {{ $activity -> title }}
@endsection

@section('header')
  <a href="{{route('pdactivity.index')}}"><b>{{ $activity -> title }}</b></a>
@endsection

@section('content')
    <div class="col-md-offset-0">
      <div class="col-md-7">
        <div class="card">
          <div class="card-block">
            <table class="table">
              <tr>
                <th colspan="2"> <i class="fa fa-bars prefix"></i> Details</th>

              </tr>
              <tr>
                <td colspan="2">{!! $activity -> details !!}</td>
              </tr>
            </table>
          </div>

        <div class="card">
          <table class="table">
            <tr>
              <th> <i class="fa fa-map-marker prefix"></i> Venue:</th>
              <td>{{ $activity -> venue }}</td>
            </tr>
            <tr>
              <th> <i class="fa fa-institution prefix"></i> Sponsor:</th>
              <td>{{ $activity -> sponsor }}</td>
            </tr>
            <tr>
              <th> <i class="fa fa-calendar prefix"></i> When:</th>
              <td>
                {{date('M j, Y', strtotime($activity -> dateFrom))}} - {{date('M j, Y', strtotime($activity -> dateTo))}}</td>
            </tr>
            <tr>
              <th> <i class="fa fa-bookmark prefix"></i> Type of Activity:</th>
              <td>{{ $pdcategory -> name}}</td>
            </tr>
          @if ($needs != NULL)
            <tr>
              <th> <i class="fa fa-tags prefix"></i> Needs Category:</th>
              <td>
                  <span class="label label-warning">{{$needs->name}}</span>
              </td>
            </tr>
          @endif

          @if ($activity->field->count() != NULL)
            <tr>
              <th> <i class="fa fa-tags prefix"></i> Tags: </th>
              <td>
                <div class="tags">
                  @foreach ($activity->field as $field)
                    <span class="label label-warning">{{$field->name}}</span>
                  @endforeach
                </div>
              </td>
            </tr>
          @endif
            <tr>
              <th> <i class="fa fa-thumb-tack prefix"></i> Interested:</th>
              <td><b>{{$activity->faculty->count()}}</b> faculty
                @if ($activity->faculty->count() == 1)
                  is
                @else
                  are
                @endif
                interested</td>
            </tr>
          </table>
        </div>
      </div>
      @if ($activity->activity_status == 0)
        @if ($needs != NULL)
          <h4 class="card-header"><b>Pending Applications</b></h4>
          <div class="card">
            <table class="table">
              @if ($faculty != NULL)
                @foreach ($faculty as $faculty)
                <tr>
                  <form class="" action="{{route('updateStatus', $activity->id)}}" method="get">
                  <td> <i class="fa fa-user prefix"></i> <b>{{$faculty->surname}}, {{$faculty->firstname}}</b> -
                    <i>{{$faculty->college->abbrv}}</i>
                        <input type="hidden" name="p_dactivity_id" value="{{$activity->id}}">
                        <input type="hidden" name="faculty_id" value="{{$faculty->id}}">
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                        <button type="submit" name="button" class="btn btn-primary btn-xs approve">Approve</button>
                  </td>
                  </form>
                </tr>
                @endforeach
              @else
                <tr>
                  <td><em>No pending applications</em></td>
                </tr>
              @endif
            </table>
          </div>
          @else
            <h4 class="card-header"><b>Pending Recommendations</b></h4>
            <div class="card">
              <table class="table">
                @if ($faculty != NULL)
                  @foreach ($faculty as $faculty)
                  <tr>
                    {{-- <form class="" action="{{route('updateStatus', $activity->id)}}" method="get"> --}}
                    <td> <i class="fa fa-user prefix"></i> <b>{{$faculty->surname}}, {{$faculty->firstname}}</b> -
                      <i>{{$faculty->college->abbrv}}</i>
                          {{-- <input type="hidden" name="p_dactivity_id" value="{{$activity->id}}"> --}}
                          {{-- <input type="hidden" name="faculty_id" value="{{$faculty->id}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <button type="submit" name="button" class="btn btn-primary btn-xs approve">Approve</button> --}}
                    </td>
                    {{-- </form> --}}
                  </tr>
                  @endforeach
                @else
                  <tr>
                    <td><em>No pending applications</em></td>
                  </tr>
                @endif
              </table>
            </div>
        @endif


      @endif
    </div>

    <div class="col-md-4">
      <div class="well">
        <dl class="dl-horizontal">
          <dt>Created At:</dt>
          <dd>{{ date('F j, Y', strtotime($activity->created_at))}}</dd>
        </dl>
        <dl class="dl-horizontal">
          <dt>Last Updated:</dt>
          <dd>{{ date('F j, Y', strtotime($activity->created_at))}}</dd>
        </dl>
        <hr>
        <div class="row">
          {{-- <div class="col-sm-6">
            {!! Html::linkRoute('pdactivity.edit', 'Edit', array($activity->id), array('class' =>
            'btn btn-primary btn-block')) !!}
          </div>
          <div class="col-sm-6">
            {!! Html::linkRoute('pdactivity.destroy', 'Edit', array($activity->id), array('class' =>
            'btn btn-danger btn-block')) !!}
          </div> --}}
          @if ($activity->createdBy == 0)
            @if ($activity->activity_status == 1)
              <div class="col-sm-12">
                    {!! Form::button('<i class="fa fa-check"></i> Activity was approved', ['class' => 'btn btn-success btn-block']) !!}
              </div>
            @else
                <div class="col-sm-6">
                  {!! Form::open(['route' => ['pdactivity.destroy', $activity->id], 'method' => 'DELETE']) !!}
                      {!! Form::button('<i class="fa fa-times"></i> Delete', ['class' => 'btn red btn-block delete', 'type' => 'submit']) !!}
                  {!! Form::close() !!}
                </div>
                <div class="col-sm-6">
                  <a href="{{route('pdactivity.edit', $activity->id)}}" class="btn btn-info btn-block"><i class="fa fa-edit"></i> Edit</a>
                </div>
            @endif

          @else
            <div class="col-sm-12">
                  {!! Form::button('Activity submitted/created by a faculty', ['class' => 'btn btn-info btn-block']) !!}
            </div>
          @endif

        </div>
      </div>
    </div>
    <div class="col-md-4">
      <h4 class="card-header"><b>Approved Participants</b></h4>
      <div class="card">
        <table class="table">
          @if ($confirmed != NULL)
            @foreach ($confirmed as $faculty)
              <tr>
                <td> <i class="fa fa-user prefix"></i> <b>{{$faculty->surname}}, {{$faculty->firstname}}</b> -
                  <i>{{$faculty->college->abbrv}}</i>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td><em>No confirmed applications</em></td>
            </tr>
          @endif
        </table>
      </div>
    </div>

  </div>
@endsection

@section('javascript')
  <script type="text/javascript">
      $(document).on("click", ".danger", function(e) {
            confirm("Are you sure you want to delete this data?");
      });
      $(document).on("click", ".approve", function(e) {
            confirm("Are you sure you want to approve the application?");
      });
  </script>
@endsection
