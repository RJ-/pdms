<!-- Sidebar Holder -->
<nav id="sidebar">
        <ul class="list-unstyled components">
          <div class="list-group">
          <li class="sidebar-header">
            <a href="{{route('home')}}" class="list-group-item list-group-item-action">
              <i class="fa fa-home fa-lg"></i> Home
            </a>
          </li>
          <li>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action">
                <i class="fa fa-list fa-lg"></i> Category
            </a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
              @foreach ($categories as $category)
                <li><a href="{{route('categories', $category->id)}}" class="list-group-item small">{{$category->name}}</a></li>
              @endforeach
            </ul>
          </li>
          <li >
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action">
                <i class="fa fa-list fa-lg"></i> Needs Category
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
              @foreach ($needs as $need)
             <li><a href="{{route('facultyneeds', $need->id)}}" class="list-group-item small">{{$need->name}}</a></li>
              @endforeach
            </ul>
          </li>
          <li>
            <a href="{{route('faculty.edit', Auth::user()->id)}}"  class="list-group-item list-group-item-action">
              <i class="fa fa-gears fa-lg"></i> Manage Profile
            </a>
          </li>
          <li>
            <a href="{{route('user.logout')}}" class="list-group-item list-group-item-action" >
              <i class="fa fa-power-off fa-lg"></i> Logout
            </a>
          </li>
        </div>
        </ul>
</nav>
