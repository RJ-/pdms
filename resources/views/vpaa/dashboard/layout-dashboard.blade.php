<!-- /.row -->
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">
                          @if ($allfaculty != NULL)
                            {{$allfaculty}}
                          @else 0
                          @endif
                        </div>
                        <div>Number of Faculty</div>
                    </div>
                </div>
            </div>
            <a href="{{route('facultyrosterVPAA')}}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-graduation-cap fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">
                          @if ($scholars != NULL)
                            {{$scholars}}
                          @else 0
                          @endif
                        </div>
                        <div>Faculty Scholars</div>
                    </div>
                </div>
            </div>
            <a href="{{route('facultyscholarVPAA')}}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-university fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">
                          @if ($gradstudies != NULL)
                            {{$gradstudies}}
                          @else 0
                          @endif
                        </div>
                        <div>Faculty in Graduate Studies</div>
                    </div>
                </div>
            </div>
            <a href="{{route('facultygradstudiesVPAA')}}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

</div>
<!-- /.row -->

<!-- 2nd row -->
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">
                          @if ($facultyPercentage != NULL)
                            {{$facultyPercentage}}
                          @else 0
                          @endif%</div>
                          <div>Faculty with Professional Development</div>
                    </div>
                </div>
            </div>
            <a href="{{route('facultywithPDVPAA')}}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-book fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">
                          @if ($numOfFacultyWithoutPD != NULL)
                            {{$numOfFacultyWithoutPD}}
                          @else 0
                          @endif
                        </div>
                        <div>Faculty without Professional Development</div>
                    </div>
                </div>
            </div>
            <a href="{{route('facultyneedPDVPAA')}}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa  fa-list-ul fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">
                          @if ($noOfPdActivities != NULL)
                            {{$noOfPdActivities}}
                          @else 0
                          @endif
                        </div>
                        <div>Number of Professional Development Activities</div>
                    </div>
                </div>
            </div>
            <a href="{{route('pdactivitiesPDVPAA')}}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.2ndrow -->

<div class="row">
  <!-- /.2ndrow -->
  <div class="col-md-6">
    <canvas id="pd" width="80" height="60"></canvas>
  </div>
  <div class="col-md-6">
    <canvas id="faculty" width="80" height="60"></canvas>
  </div>
</div>
