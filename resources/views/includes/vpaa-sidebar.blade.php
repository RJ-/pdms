<!-- Sidebar Holder -->
<nav id="sidebar">
    <ul class="list-unstyled components">
      <div class="list-group">
        <li class="sidebar-header">
          <a href="{{route('vpaa.index')}}" class="list-group-item list-group-item-action">
            <i class="fa fa-dashboard fa-lg"></i> VPAA's Dashboard
          </a>
        </li>
        <li>
          <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action">
              <i class="fa fa-list fa-lg"></i> Colleges
          </a>
          <ul class="collapse list-unstyled" id="homeSubmenu">
            <li>
              @foreach ($colleges as $college)
              <a href="{{route('vpaa.show',$college->id)}}" class="list-group-item list-group-item-action">
                <i class="fa fa-angle-right fa-lg"></i> {{$college->name}}
              </a>
              @endforeach
            </li>
          </ul>
        </li>
        <li>
          <a href="{{route('VpaaProfile', Auth::user()->id)}}" class="list-group-item list-group-item-action">
            <i class="fa fa-gears fa-lg"></i> Manage Profile
          </a>
        </li>
        <li>
          <a href="{{route('vpaa.logout')}}" class="list-group-item list-group-item-action">
            <i class="fa fa-power-off fa-lg"></i> Logout
          </a>
        </li>
      </div>
    </ul>
</nav>
