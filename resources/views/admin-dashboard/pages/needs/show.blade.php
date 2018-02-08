@extends('layouts.adminMaster')

@section('title')
  Training Needs | {{$needs->name}}
@endsection

@section('content')
  @section('header')
  <div class="row">
      <div class="col-md-12">
        <div class="col-md-8">
          <b><a href="{{route('needs.index')}}">{{$needs->name}} </a></b>
        </div>

        <div class="col-md-4">
          <a href="{{route('needs.edit',$needs->id)}}" class="btn btn-info pull-right btn-md"><i class="fa fa-edit"></i> Edit Title</a>
            <a href="{{route('pdactivity.create')}}" class="btn btn-success pull-right btn-md"><i class="fa fa-plus"></i> Add activity</a>

        </div>
      </div>
  </div>
  @endsection
  <!-- /. header row -->
  <div class="row">
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-green">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-book fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{$activity}}</div>
                          <div>2018 activities relevant to the category</div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-yellow">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-users fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{$needs->faculty()->count()}}</div>
                          <div>Number of Faculty in Need</div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-check-square-o fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{$activity}}</div>
                          <div>Number of Trained Faculty</div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-red">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-user fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{$needs->faculty()->count()}}</div>
                          <div>Remaining Faculty to be Trained</div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- /.panel row -->
  <div class="row">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs md-pills pills-ins flex-center" role="tablist">
        <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#panel14" role="tab"> List of Faculty</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" data-toggle="tab" href="#panel10" role="tab"> 2018</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#panel11" role="tab"> 2017</a>
        </li>
    </ul>


    <!-- Tab panels -->
    <div class="tab-content">
        <!--Panel 4-->
        <div class="tab-pane fade in " id="panel14" role="tabpanel">
          <!--Panel-->
          <div class="row">
              <div class="col-md-12">
                @if ($needs->faculty == NULL)
                    <h2>No registered faculty yet.</h2>
                  @else
                <table class="table">
                  <thead class="thead">
                    <tr>
                      <th>#</th>
                      <th>@sortablelink('surname', 'Name')</th>
                      <th>@sortablelink('college_id', 'College')</th>
                      <th>@sortablelink('acadrank_id', 'Academic Rank')</th>
                      <th><a href="#">Field of Specialization</a></th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($needs->faculty as $faculty)
                          <tr>
                            <th>{{$counter++}}</th>
                            <td><a href="{{route('showfaculty',$faculty->id)}}">{{$faculty->surname}}, {{$faculty->firstname}}</a></td>
                            <td>{{$faculty->college->name}}</td>
                            <td>{{$faculty->acadrank->name}}</td>
                            <td>
                              @foreach ($faculty->field as $field)
                              <span class="label label-primary">{{$field->name}} </span>&ensp;
                              @endforeach
                            </td>
                          </tr>
                        @endforeach
                    @endif

                  </tbody>
                </table>
              </div>
              <center>
                @if ($needs->faculty != NULL)
                  {{-- {!! $needs->appends(\Request::except('page'))->render() !!} --}}
                @endif
              </center>
          </div>
          <!--/.Panel-->
        </div>
        <!--/.Panel 4-->

        <!--Panel 0-->
        <div class="tab-pane fade in active" id="panel10" role="tabpanel">
          <!--Panel-->
          <div class="row">
              <div class="col-md-12">
                @if ($thisyear->count() == NULL)
                    <h2>No registered activity yet.</h2>
                    <a href="{{route('pdactivity.create')}}"> <button class="btn btn-primary" type="button" name="button">Add activity</button></a>
                  @else
                    @php
                      $counter = 1;
                    @endphp
                <table class="table">
                  <thead class="thead">
                    <tr>
                      <th>#</th>
                      <th class="col-md-5"><a href="#">Title</a></th>
                      <th class="col-md-3"><a href="#">Venue</a></th>
                      <th class="col-md-2"><a href="#">Sponsor</a> </th>
                      <th class="col-md-2"><a href="#">Inclusive Dates</a> </th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($thisyear as $act)
                          <tr>
                            <th>{{$counter++}}</th>
                            <td>{{$act->title}}</td>
                            <td>{{$act->venue}}</td>
                            <td>{{$act->sponsor}}</td>
                            <td>{{date('M d, Y', strtotime($act->dateFrom))}} - <br> {{date('M d, Y', strtotime($act->dateTo))}}</td>
                          </tr>
                        @endforeach
                    @endif

                  </tbody>
                </table>
              </div>
              <center>
                @if ($thisyear->count() != NULL)
                  {!! $thisyear->appends(\Request::except('page'))->render() !!}
                @endif
              </center>
          </div>
            <!--/.Panel-->
        </div>
        <!--/.Panel-->

        <!--Panel 0-->
        <div class="tab-pane fade in" id="panel11" role="tabpanel">
          <!--Panel-->
          <div class="row">
              <div class="col-md-12">
                @if ($lastyear->count() == NULL)
                    <h2>No registered activity yet.</h2>
                    <a href="{{route('pdactivity.create')}}"> <button class="btn btn-primary" type="button" name="button">Add activity</button></a>
                  @else
                    @php
                      $counter = 1;
                    @endphp
                <table class="table">
                  <thead class="thead">
                    <tr>
                      <th>#</th>
                      <th class="col-md-5"><a href="#">Title</a></th>
                      <th class="col-md-3"><a href="#">Venue</a></th>
                      <th class="col-md-2"><a href="#">Sponsor</a> </th>
                      <th class="col-md-2"><a href="#">Inclusive Dates</a> </th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($lastyear as $act)
                          <tr>
                            <th>{{$counter++}}</th>
                            <td>{{$act->title}}</td>
                            <td>{{$act->venue}}</td>
                            <td>{{$act->sponsor}}</td>
                            <td>{{date('M d, Y', strtotime($act->dateFrom))}} - <br> {{date('M d, Y', strtotime($act->dateTo))}}</td>
                          </tr>
                        @endforeach
                    @endif

                  </tbody>
                </table>
              </div>
              <center>
                @if ($lastyear->count() != NULL)
                  {!! $lastyear->appends(\Request::except('page'))->render() !!}
                @endif
              </center>
          </div>
            <!--/.Panel-->
        </div>
        <!--/.Panel-->

    </div>
</div>
@endsection
