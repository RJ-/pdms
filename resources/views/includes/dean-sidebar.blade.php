<!-- Sidebar Holder -->
<nav id="sidebar">
    <ul class="list-unstyled components">
      <div class="list-group">
        <li class="sidebar-header">
          <a href="{{route('dean.index')}}" class="list-group-item list-group-item-action">
            <i class="fa fa-dashboard fa-lg"></i> Dean's Dashboard
          </a>
        </li>
        <li>
          <a href="{{route('manageactivities')}}" class="list-group-item list-group-item-action">
            <i class="fa fa-list-alt fa-lg"></i> Manage Development Activities
          </a>
        </li>

        <li>
          <a href="{{route('collegefacultydevelopment', Auth::user()->college->id)}}" class="list-group-item list-group-item-action">
            <i class="fa fa-user fa-lg"></i> Faculty Development
          </a>
        </li>

        <li>
          <a href="{{route('DeanProfile', Auth::user()->id)}}" class="list-group-item list-group-item-action">
            <i class="fa fa-gears fa-lg"></i> Manage Profile
          </a>
        </li>

        <li>
          <a href="{{route('dean.logout')}}" class="list-group-item list-group-item-action">
            <i class="fa fa-power-off fa-lg"></i> Logout
          </a>
        </li>
      </div>
    </ul>
</nav>
