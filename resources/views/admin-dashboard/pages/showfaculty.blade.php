@extends('layouts.adminMaster')

@section('title')
  View Faculty
@endsection

@section('content')
  @section('header')<i class="fa fa-user prefix"></i>
    <a href="{{''}}" onclick="location.href = document.referrer; return false;"><b>{{$faculty-> firstname}} {{$faculty-> middlename}} {{$faculty-> surname}}</b></a>
  @endsection
  <div class="container">
    <div class="row">
      <div class="col-md-11">
            <table class="table">
              <tr>
                <th style="width:250px;"> <i class="fa fa-suitcase prefix"></i> Position:</th>
                <td>{{$faculty-> acadrank -> name}}</td>
              </tr>
              <tr>
                <th> <i class="fa fa-graduation-cap prefix"></i> Email:</th>
                <td>
                  {{$faculty-> email}}</td>
              </tr>
              <tr>
                <th><i class="fa fa-tag prefix"></i> Field of Specialization:</th>
                <td>
                  <div class="tags">|
                    @foreach ($faculty->field as $field)
                      <a href="#"><span class="label label-default">{{$field->name}}</span></a>  |
                    @endforeach
                  </div>
                </td>
              </tr>
              <tr>
                <th><i class="fa fa-tag prefix"></i> Faculty Development Needs:</th>
                <td>
                  <div class="tags">|
                    @foreach ($faculty->needs as $needs)
                      <a href="#"><span class="label label-default">{{$needs->name}}</span></a>  |
                    @endforeach
                  </div>
                </td>
              </tr>
            </table>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs md-pills pills-ins flex-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#panel10" role="tab"><i class="fa fa-graduation-cap"></i> Education Background</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#panel11" role="tab"><i class="fa fa-users"></i> Seminars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#panel12" role="tab"><i class="fa fa-book"></i> Training and Workshops</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#panel13" role="tab"><i class="fa fa-flask"></i> Short Courses</a>
                </li>
            </ul>

            <!-- Tab panels -->
            <div class="tab-content" >
                <!--Panel 0-->
                <div class="tab-pane fade in active" id="panel10" role="tabpanel">
                  <!--Panel-->
                  <div class="card" >
                      <div class="card-block" style="margin-left: 30px;">
                        @foreach ($educbackground as $educbackgrounds)
                          <hr>
                          <div class="row">
                            <div class="col-md-6">
                              <h4 class="card-title text-primary"><b>{{$educbackgrounds->category->name}}</b>
                                | <i style="font-size: 18px;">{{$educbackgrounds-> yearstarted}} -
                                  @if($educbackgrounds->yeargraduated != NULL)
                                    {{$educbackgrounds-> yeargraduated}}
                                  @else
                                    {{"on-going"}}
                                  @endif
                                </i>
                              </h4>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6"><i class="fa fa-suitcase prefix"></i>
                                <b>Course: </b>{{$educbackgrounds-> course}}</div>
                          </div>
                          @if ($educbackgrounds-> major != NULL)
                            <div class="row">
                              <div class="col-md-6"><i class="fa fa-graduation-cap prefix"></i>
                               <b>Major: </b>{{$educbackgrounds-> major}}</div>
                            </div>
                          @endif
                          <div class="row">
                              <div class="col-md-6"><i class="fa fa-tag prefix"></i>
                                <b>School:</b> {{$educbackgrounds-> school}}</div>
                          </div>
                          @if ($educbackgrounds-> scholarship != NULL)
                            <div class="row">
                              <div class="col-md-6"><i class="fa fa-flask prefix"></i>
                                <b>Scholarship:</b> {{$educbackgrounds-> scholarship}}</div>
                            </div>
                            <hr>
                          @endif
                          @if ($educbackgrounds-> award != NULL)
                            <div class="row">
                                <div class="col-md-6"><i class="fa fa-flask prefix"></i>
                                  <b>Award: </b>{{$educbackgrounds-> award}}</div>
                            </div>
                          @endif
                        @endforeach
                      </div>
                      <hr>
                  </div>
                  <!--/.Panel-->
                </div>
                <!--/.Panel 0-->

                <!--Panel 1-->
                <div class="tab-pane fade" id="panel11" role="tabpanel">
                  <!--Panel-->
                  <div class="card">
                      <div class="card-block" style="margin-left: 30px;">
                        @if ($seminars == NULL)
                          <div class="card-block">
                            <hr>
                            <a class="btn btn-block btn-warning" href="#">
                               NO SEMINARS ATTENDED</a>
                            <hr>
                          </div>
                        @endif
                        @foreach ($seminars as $seminar)
                          @if ($seminar->activity_status == 0)
                            <i class="fa fa-warning"></i><em class="text-warning"> Approval Pending</em>
                          @endif
                          <div class="row">
                            <div class="col-md-11">
                              <h4 class="card-title text-primary"><b>{{$seminar->title}}</b>
                              </h4>
                              <p><i>{!!$seminar-> details!!}</i></p>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-md-11"><i class="fa fa-suitcase prefix"></i>
                                <b>Venue: </b>{{$seminar-> venue}}</div>
                          </div>
                            <div class="row">
                              <div class="col-md-11"><i class="fa fa-graduation-cap prefix"></i>
                               <b>Sponsor: </b>{{$seminar-> sponsor}}</div>
                            </div>
                          <div class="row">
                              <div class="col-md-6"><i class="fa fa-tag prefix"></i>
                                <b>Inclusive Dates:</b>
                                {{date('M j, Y', strtotime($seminar -> dateFrom))}} - {{date('M j, Y', strtotime($seminar -> dateTo))}}
                              </div>
                          </div>
                          <hr>
                        @endforeach
                      </div>
                  </div>
                  <!--/.Panel-->
                </div>
                <!--/.Panel 1-->

                <!--Panel 2-->
                <div class="tab-pane fade" id="panel12" role="tabpanel">
                  <!--Panel-->
                  <div class="card">
                      <div class="card-block" style="margin-left: 30px;">
                        @if ($trainings == NULL)
                          <div class="card-block">
                            <hr>
                            <a class="btn btn-block btn-warning" href="#">
                              NO TRAININGS OR WORKSHOPS ATTENDED</a>
                            <hr>
                          </div>
                        @endif
                        @foreach ($trainings as $training)
                          @if ($training->activity_status == 0)
                            <i class="fa fa-warning"></i><em class="text-warning"> Approval Pending</em>
                          @endif
                          <div class="row">
                            <div class="col-md-11">
                              <h4 class="card-title text-primary"><b>{{$training->title}}</b>
                              </h4>
                              <p><i>{!!$training-> details!!}</i></p>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-md-11"><i class="fa fa-suitcase prefix"></i>
                                <b>Venue: </b>{{$training-> venue}}</div>
                          </div>
                            <div class="row">
                              <div class="col-md-11"><i class="fa fa-graduation-cap prefix"></i>
                               <b>Sponsor: </b>{{$training-> sponsor}}</div>
                            </div>
                          <div class="row">
                              <div class="col-md-6"><i class="fa fa-tag prefix"></i>
                                <b>Inclusive Dates:</b>
                                {{date('M j, Y', strtotime($training -> dateFrom))}} - {{date('M j, Y', strtotime($seminar -> dateTo))}}
                              </div>
                          </div>
                          <hr>
                        @endforeach
                      </div>
                  </div>
                  <!--/.Panel-->
                </div>
                <!--/.Panel 2-->

                <!--Panel 3-->
                <div class="tab-pane fade" id="panel13" role="tabpanel">
                  <!--Panel-->
                  <div class="card">
                      <div class="card-block" style="margin-left: 30px;">
                        @if ($courses == NULL)
                          <div class="card-block">
                            <hr>
                            <a class="btn btn-block btn-warning" href="#">
                              NO SHORT COURSES ATTENDED</a>
                            <hr>
                          </div>
                        @endif
                        @foreach ($courses as $course)
                          @if ($course->activity_status == 0)
                            <i class="fa fa-warning"></i><em class="text-warning"> Approval Pending</em>
                          @endif
                          <div class="row">
                            <div class="col-md-11">
                              <h4 class="card-title text-primary"><b>{{$course->title}}</b>
                              </h4>
                              <p><i>{!!$course-> details!!}</i></p>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-md-11"><i class="fa fa-suitcase prefix"></i>
                                <b>Venue: </b>{{$course-> venue}}</div>
                          </div>
                            <div class="row">
                              <div class="col-md-11"><i class="fa fa-graduation-cap prefix"></i>
                               <b>Sponsor: </b>{{$course-> sponsor}}</div>
                            </div>
                          <div class="row">
                              <div class="col-md-6"><i class="fa fa-tag prefix"></i>
                                <b>Inclusive Dates:</b>
                                {{date('M j, Y', strtotime($course -> dateFrom))}} - {{date('M j, Y', strtotime($seminar -> dateTo))}}
                              </div>
                          </div>
                          <hr>
                        @endforeach
                      </div>
                  </div>
                  <!--/.Panel-->
                </div>
                <!--/.Panel 3-->

            </div>
      </div>
    </div>
  </div>
@endsection
