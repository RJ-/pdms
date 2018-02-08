@extends('layouts.adminMaster')

@section('title')
  Activity: {{ $activity -> title }}
@endsection
@section('stylesheet')
  <style media="screen">
  button {
    width: 100px; // whatever your button's width
    margin: 0 auto; // auto left/right margins
  }
  </style>
@endsection
@section('content')
  @section('header')
<b>{{ $activity -> title }}</b>
  @endsection
    <div class="col-md-offset-0">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-block">
              <table class="table">
                <tr>
                  <th colspan="2"> <i class="fa fa-bars prefix"></i> Details</th>
                </tr>
                <tr>
                  <td colspan="2">{!! $activity -> details !!}</td>
                </tr>
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
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-6">
          @foreach ($faculty as $key => $fac)
          <div class="row">
              <div class="card">
                <div class="card-block">
                    <table class="table">
                      <tr>
                        <th colspan="2"> <i class="fa fa-user prefix"></i>
                          <b class="text-primary">{{$fac->firstname}} {{$fac->surname}}</b> - <i>{{$fac->college->name}}</i>
                        </th>
                      </tr>
                      @if ($certificate[$key]->file != NULL)
                      <tr>
                        <th colspan="2"> <i class="fa fa-certificate prefix"></i> Certificate uploaded at: {{ date('F j, Y',strtotime($certificate[$key]->uploaded_at ))}}</th>
                      </tr>
                      <tr>
                        <td colspan="2"><img src="{{asset('files/'.$certificate[$key]->file)}}" alt="Image of a certificate. Filename: {{$certificate[$key]->file}}"></td>
                      </tr>
                        @else
                          <tr>
                            <th colspan="2"> <i class="fa fa-certificate prefix"></i>
                              <b class="text-danger">Certificate was not yet submitted.</b>
                            </th>
                          </tr>
                      @endif
                      <tr>
                        <td>
                            {!! Form::model($activity, ['route' => ['hrdNotifyFacultyRequirements', $activity->id],'method' => 'PUT']) !!}
                                <input type="hidden" name="faculty_id" value="{{$fac->id}}">
                                <input type="hidden" name="p_dactivity_id" value="{{$activity->id}}">
                                <a id="popoverData" href="#" style="max-width: 1000px!important; width:auto;"
                                data-content="
                                  <input name='message' type='text' size='400' style='margin-bottom: 10px;' value='' required></input>
                                  <button  class='btn btn-warning btn-sm warning'  style='display: block; margin: 0 auto;'> <i class='fa fa-plane'></i> Send</button>
                                "
                                rel="popover" data-placement="top" data-original-title="Short Message"
                                data-trigger="click" data-toggle="popover" class="btn btn-info btn-sm pull-right"> <i class="fa fa-bell"></i> Notify
                                </a>
                            {!! Form::close() !!}
                        </td>
                        <td>
                          {!! Form::model($activity, ['route' => ['hrdApproveActivity', $activity->id],'method' => 'PUT'])!!}
                              <input type="hidden" name="faculty_id" value="{{$fac->id}}">
                              <input type="hidden" name="p_dactivity_id" value="{{$activity->id}}">
                              <button  class="btn green btn-sm success"> <i class="fa fa-thumbs-up"></i> Approve</button>
                          {!! Form::close() !!}
                        </td>
                      </tr>
                    </table>
                </div>
              </div>
            </div>
            @endforeach
      </div>
  </div>
</div>
@endsection

@section('javascript')
  <script type="text/javascript">
      $(document).on("click", ".warning", function(e) {
        if (confirm("Notify the applicant?")) {
         }else {
          e.preventDefault();
         }
      });
      $(document).on("click", ".success", function(e) {
        if (confirm("Are you sure you want to approve the application?")) {
        }else{
          e.preventDefault();
        }

      });
  </script>
  <script type="text/javascript">
  $('[data-toggle="popover"]').popover({html:true});
  </script>
@endsection
