<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{route('admin')}}"><b class="text-primary">PARSU | Professional Development Management System</b></a>
    </div>
    <!-- /.navbar-header -->

    <!-- navbar-top-links -->
    @if (Auth::check())
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope fa-fw"></i>
            @if (count(auth()->user()->unreadNotifications) != 0)
              <span class="badge badge-danger">{{count(auth()->user()->unreadNotifications)}}</span>
            </a>
            @endif
            <ul class="dropdown-menu dropdown-messages" id="markasread" onclick="markNotificationAsRead('{{count(auth()->user()->unreadNotifications)}}')">
              @forelse (auth()->user()->unreadNotifications->slice(0,5)  as $notification)
              <li>
                @include('includes.notification.'.snake_case(class_basename($notification->type)))
              </li>
              <li class="divider"></li>
              @empty
                <a class="text-center">You have no new notifications</a>
              @endforelse
              <li class="divider"></li>
              <a href="#"><em>Earlier</em></a>
              @forelse (auth()->user()->readNotifications->slice(0,5)  as $notification)
              <li>
                @include('includes.notification.'.snake_case(class_basename($notification->type)))
              </li>
              <li class="divider"></li>
              @empty
                <li class="divider"></li>
                <center>You have no earlier notifications</center>
                <li class="divider"></li>
              @endforelse
              <li>
                  <a class="text-center" href="{{route('HrdNotification')}}">
                      <strong>Read All Notifications</strong>
                      <i class="fa fa-angle-right"></i>
                  </a>
              </li>
            </ul>
            <!-- /.dropdown-messages -->
        </li>
        <!-- /.dropdown -->

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{route('HrdProfile',Auth::user()->id)}}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{route('admin.logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
  @endif
    <!-- /.navbar-top-links -->

    <!-- navbar-static-side -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="{{route('admin')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-user fa-fw"></i> Faculty Development<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            @foreach ($colleges as $college)
                              <a href="{{route('facultydevelopment', $college->id)}}">
                                {{$college->name}}
                              </a>
                            @endforeach
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                  <a href="#"><i class="fa fa-sitemap fa-fw"></i> Training Plan<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
                      <li>
                          <a href="{{route('pdactivity.index')}}">View Activities</a>
                      </li>
                      <li>
                          <a href="{{route('pdactivity.create')}}">Post an Activity</a>
                      </li>
                      <li>
                          <a href="{{route('needs.index')}}">Manage Faculty Needs Category</a>
                      </li>
                  </ul>
                  <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-folder fa-fw"></i> Content Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('administrators.index')}}">Manage Administrators</a>
                        </li>
                        <li>
                            <a href="{{route('category.index')}}">Manage Specilization Category</a>
                        </li>
                        <li>
                            <a href="{{route('campus-college.index')}}">Manage Campus and Colleges</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i> Faculty Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('registerfaculty')}}">Register Faculty</a>
                        </li>
                        <li>
                            <a href="{{route('viewfaculty')}}">View Faculty</a>
                        </li>
                        <li>
                            <a href="{{route('viewSubmittedPD')}}">Professional Development Applications</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>

{{-- <li>
    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="flot.html">Flot Charts</a>
        </li>
        <li>
            <a href="morris.html">Morris.js Charts</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
</li>
<li>
    <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
</li>
<li>
    <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="panels-wells.html">Panels and Wells</a>
        </li>
        <li>
            <a href="buttons.html">Buttons</a>
        </li>
        <li>
            <a href="notifications.html">Notifications</a>
        </li>
        <li>
            <a href="typography.html">Typography</a>
        </li>
        <li>
            <a href="icons.html"> Icons</a>
        </li>
        <li>
            <a href="grid.html">Grid</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#">Second Level Item</a>
        </li>
        <li>
            <a href="#">Second Level Item</a>
        </li>
        <li>
            <a href="#">Third Level <span class="fa arrow"></span></a>
            <ul class="nav nav-third-level">
                <li>
                    <a href="#">Third Level Item</a>
                </li>
                <li>
                    <a href="#">Third Level Item</a>
                </li>
                <li>
                    <a href="#">Third Level Item</a>
                </li>
                <li>
                    <a href="#">Third Level Item</a>
                </li>
            </ul>
            <!-- /.nav-third-level -->
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="blank.html">Blank Page</a>
        </li>
        <li>
            <a href="login.html">Login Page</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li> --}}
{{--
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-alerts">
        <li>
            <a href="#">
                <div>
                    <i class="fa fa-comment fa-fw"></i> New Comment
                    <span class="pull-right text-muted small">4 minutes ago</span>
                </div>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="#">
                <div>
                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                    <span class="pull-right text-muted small">12 minutes ago</span>
                </div>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="#">
                <div>
                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                    <span class="pull-right text-muted small">4 minutes ago</span>
                </div>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="#">
                <div>
                    <i class="fa fa-tasks fa-fw"></i> New Task
                    <span class="pull-right text-muted small">4 minutes ago</span>
                </div>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="#">
                <div>
                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                    <span class="pull-right text-muted small">4 minutes ago</span>
                </div>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a class="text-center" href="#">
                <strong>See All Alerts</strong>
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
    <!-- /.dropdown-alerts -->
</li> --}}
{{-- <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-tasks">
        <li>
            <a href="#">
                <div>
                    <p>
                        <strong>Task 1</strong>
                        <span class="pull-right text-muted">40% Complete</span>
                    </p>
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                            <span class="sr-only">40% Complete (success)</span>
                        </div>
                    </div>
                </div>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="#">
                <div>
                    <p>
                        <strong>Task 2</strong>
                        <span class="pull-right text-muted">20% Complete</span>
                    </p>
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                            <span class="sr-only">20% Complete</span>
                        </div>
                    </div>
                </div>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="#">
                <div>
                    <p>
                        <strong>Task 3</strong>
                        <span class="pull-right text-muted">60% Complete</span>
                    </p>
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                            <span class="sr-only">60% Complete (warning)</span>
                        </div>
                    </div>
                </div>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="#">
                <div>
                    <p>
                        <strong>Task 4</strong>
                        <span class="pull-right text-muted">80% Complete</span>
                    </p>
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                            <span class="sr-only">80% Complete (danger)</span>
                        </div>
                    </div>
                </div>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a class="text-center" href="#">
                <strong>See All Tasks</strong>
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
    <!-- /.dropdown-tasks -->
</li>
<!-- /.dropdown --> --}}
