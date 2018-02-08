@extends('layouts.vpaa-activity')

@section('title')
Vice-President for Academic Affairs
@endsection

@section('content')
  <div class="view">
      <!--Intro content-->
      <div class="full-bg-img flex-center"><br>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="description">
                <h4 class="h4-responsive wow fadeIn">Vice-President for Academic Affairs</h4>
                <hr class="hr-light responsive wow fadeIn">
                <h1 class="h1-responsive wow fadeIn">
                  {{Auth::user()->firstname}} {{substr(Auth::user()->middlename, 0, 1)}}. {{Auth::user()->surname}}
                </h1>
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
          Dashboard
        </div>
      </b>
    </h2>
  <hr>
      <div class="row">
        <div class="col-md-12">

          @include('vpaa.dashboard.layout-dashboard')

        </div>
      </div>
    </div>
  </div>
@endsection


@section('javascript')
  @include('footervarview')
@include('includes.dashboard')
<script type="text/javascript">
$(".nav-tabs a.nav-link").click(function(){
	var x = $(this).attr("href");
	x = x.replace("#", "");
	$(".tab-content .tab-pane").each(function(){
		var y = $(this).attr("id");
		if (x == y) $(this).addClass("active show");
		else $(this).removeClass("active show");
	});
});
</script>
@endsection
