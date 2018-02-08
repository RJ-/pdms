
  <!--Navbar-->
  <nav class="navbar navbar-dark navbar-fixed-top scrolling-navbar">
      <!-- Collapse button-->
      <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapseEx2">
          <i class="fa fa-bars"></i>
      </button>

      <div class="container">
        <!--Collapse content-->
        <div class="collapse navbar-toggleable-xs" id="collapseEx2">
            <!--Navbar Brand-->
            <a class="navbar-brand" style="color: #FFF" href="{{route('president.index')}}">
              <img src="{{asset('images/logo.png')}}" width="30px" alt="LOGO"> PDMS</a>
            <!--Links-->
            @if (Auth::check())
              <ul class="nav navbar-nav pull-right">
                <li class="nav-item">
                  <a class="navbar-brand" style="color: #FFF" href="{{route('president.index')}}">University President</a>
                </li>
                <li class="nav-item dropdown btn-group">
                    <a class="nav-link" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-globe fa-lg" aria-hidden="true"></i>
                      @if (count(auth()->user()->unreadNotifications) != 0)
                        <span class="panel badge badge-danger red">{{count(auth()->user()->unreadNotifications)}}</span>
                      @endif
                    </a>
                    <div class="dropdown-menu dropdown" aria-labelledby="dropdownMenu1" id="markasread" onclick="markNotificationAsRead('{{count(auth()->user()->unreadNotifications)}}')">
                      @forelse (auth()->user()->unreadNotifications->slice(0,5)  as $notification)
                        @include('includes.notification.'.snake_case(class_basename($notification->type)))
                      @empty
                        <small><a class="dropdown-item text-primary">You have no new notifications</a></small>
                      @endforelse
                      <hr>
                      <a href="#"><small class="text-primary"><em>Earlier</em></small></a>
                      @forelse (auth()->user()->readNotifications->slice(0,5)  as $notification)
                        @include('includes.notification.'.snake_case(class_basename($notification->type)))
                      @empty
                        <small style="font-size:11px; "><a class="dropdown-item text-black">You have no earlier notifications</a></small>
                      @endforelse
                        <center><small style="font-size:11px"><a class="dropdown-item text-primary" href="{{route('PresNotification')}}">View all notifications</a></small></center>
                    </div>
                </li>
                <li class="nav-item dropdown btn-group">
                    <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <div class="dropdown-menu dropdown" aria-labelledby="dropdownMenu1">
                        <a class="dropdown-item" href="{{route('PresidentProfile', Auth::user()->id)}}"><i class="fa fa-user"></i> Manage Profile </a>
                        <a class="dropdown-item" href="{{route('president.logout')}}"><i class="fa fa-power-off"></i> Logout</a>
                    </div>
                </li>
              </ul>
            @endif
        </div>
        <!--/.Collapse content-->
      </div>
  </nav>
  <!--/.Navbar-->
