@extends('layouts.vpaa-activity')

@section('title')
  Manage Development Record
@endsection

@section('content')
  <div class="view hm-blue-darken">
      <!--Intro content-->
      <div class="full-bg-img flex-center"><br>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="description">
                <h1 class="h1-responsive wow fadeIn"><i class="fa fa-cogs"></i> Manage your Profile</h1>
                <hr class="hr-light responsive wow fadeIn">
              </div>
            </div>
          </div>
        </div><!--/.container-->
      </div>
  </div>
<div class="wrapper">
  @include('includes.vpaa-sidebar')
  <div id="content" class="container">
    <h2>
      <b>
        <div class="navbar-header">
                <a href="#" class="glyphicon glyphicon-align-justify btn-menu toggle"><i  id="sidebarCollapse"    class="fa fa-bars"></i></a>
                <a href="{{route('vpaa.index')}}"> </i> Dashboard</a>
                  | Manage Profile and Security Settings
      </div>
    </b>
    </h2>
  <hr>
    <div class="row">
    <div class="col-md-12">
      @include('vpaa.edit-profile-modal')
      <div class="card">
        <div class="card-block">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-md-5">
              <h2><i class="fa fa-user"></i> Your Profile Settings</h2>
              <p>Manage your profile details here.</p>
            </div>
            <div class="col-md-7">
              <div class="card">
                <div class="card-block" data-toggle="modal" data-target="#profile" style="cursor: pointer;">
                  <div class="col-lg-4">
                      <b>Manage Profile</b>
                  </div>
                  <div class="col-lg-6">
                    <p class="text-muted">Change your profile details such as username, email address, etc.</p>
                  </div>
                  <div class="pull-right">
                    <i class="fa fa-angle-right prefix"></i>
                  </div>
                </div>
              <hr>
              </div>
            </div>
          </div>
        <hr>
          <div class="row">
            <div class="col-md-5">
              <h2><i class="fa fa-wrench"></i> Your Security Settings</h2>
              <p>Manage/Reset your password here.</p>
                <i class="fa fa-info"></i><em class="text-primary"> Last Updated: {{date('F j, Y - h:i a', strtotime(Auth::user()->updated_at))}}</em>
            </div>
            <div class="col-md-7">
              <div class="card">
                <div class="card-block" data-toggle="modal" data-target="#password" style="cursor: pointer;">
                  <div class="col-lg-4">
                      <b>Change Password</b>
                  </div>
                  <div class="col-lg-6">
                    <p class="text-muted">Change your password often for a more secure access to account.</p>
                  </div>
                  <div class="pull-right">
                    <i class="fa fa-angle-right prefix"></i>
                  </div>
                </div>
              <hr>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection

@section('javascript')
  <script type="text/javascript">
      $(document).on("click", ".cancel", function(e) {
            confirm("Are you sure you want to cancel update?");
      });
      $(document).on("click", ".submit", function(e) {
              confirm("Confirm and Save Data?");
      });
  </script>
@endsection
