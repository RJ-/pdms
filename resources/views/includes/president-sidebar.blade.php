<!-- Sidebar Holder -->
<nav id="sidebar">
    <ul class="list-unstyled components">
      <div class="list-group">
          <li>
            <a href="{{route('president.index')}}" class="list-group-item">
              <i class="fa fa-dashboard fa-lg"></i> Presidents's Dashboard
            </a>
          </li>
          <li>
            <a href="{{route('president.show','manage')}}" class="list-group-item small">
              <i class="fa fa-list-alt fa-lg"></i> Manage Development Activities
            </a>
          </li>
          <li>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="list-group-item small" >
              <i class="fa fa-users fa-lg"></i> Faculty Development
            </a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
              @foreach ($colleges as $college)
              <li>
                <a href="{{route('presidentfacultydevelopment', $college->id)}}" class="list-group-item small">
                  <i class="fa fa-angle-right fa-lg"> </i> {{$college->name}}
                </a>
              </li>
              @endforeach
            </ul>
          </li>
          <li>
            <a href="{{route('PresidentProfile', Auth::user()->id)}}" class="list-group-item small">
              <i class="fa fa-gears fa-lg"></i> Manage Profile
            </a>
          </li>
          <li>
            <a href="{{route('president.logout')}}" class="list-group-item small ">
              <i class="fa fa-power-off fa-lg"></i> Logout
            </a>
          </li>
      </div>
    </ul>
</nav>
