<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet" type="text/css" >

    <!-- MetisMenu CSS -->
    <link href="{{ asset('vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('vendor/morrisjs/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}">

    {{-- <link href="{{ asset('css/alertify.css') }}" rel="stylesheet" type="text/css" > --}}

    @yield('stylesheets')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style media="screen">
    .nav-tabs.centered > li, .nav-pills.centered > li {
      float:none;
      display:inline-block;
      *display:inline; /* ie7 fix */
       zoom:1; /* hasLayout ie7 trigger */
    }
    .table-responsive {
      display: block;
      width: 100%;
      min-height: 0%;
      overflow-x: auto;
    }

    .nav-tabs.centered, .nav-pills.centered {
      text-align:center;
    }
    </style>
    @include('admin-dashboard.pages.includes.nav')
</head>

  <body>
    <div id="wrapper">
      <div id="page-wrapper" style="padding: 30px">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@yield('header')</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /. header row -->

          @include('admin-dashboard.pages.includes._messages')

          @yield('content')
    </div><!--/.page wrapper-->
  </div><!--/.wrapper-->
  </body>
        <!-- jQuery -->
        <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

        <!-- bootbox Core JavaScript -->
        <script src="{{asset('vendor/bootstrap/js/bootbox.min.js')}}"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{asset('vendor/metisMenu/metisMenu.min.js')}}"></script>

        <!-- Morris Charts JavaScript -->
        <script src="{{asset('vendor/raphael/raphael.min.js')}}"></script>
        <script src="{{asset('vendor/morrisjs/morris.min.js')}}"></script>
        <script src="{{asset('data/morris-data.js')}}"></script>

        <!-- Custom Theme JavaScript -->
        <script src="{{asset('dist/js/sb-admin-2.js')}}"></script>
        <!-- SCRIPTS -->
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>

        <script type="text/javascript" src="{{ asset('js/notificationHrd.js') }}"></script>

        <script type="text/javascript" src="{{ asset('js/Chart.min.js') }}"></script>

        <script>
          function goBack() {
              window.history.go(-1);
          }
        </script>

        {{-- <script type="text/javascript" src="{{ asset('js/alertify.js') }}"></script>

        @if (session('success'))
          <script type="text/javascript">
            $(document).ready(function(){
              alertify.logPosition("top right");
              alertify.success('{{session('success')}}');
            })
          </script>
        @endif

        @if (session('error'))
          <script type="text/javascript">
            $(document).ready(function(){
              alertify.logPosition("top right");
              alertify.error('{{session('error')}}');
            })
          </script>
        @endif --}}

        @yield('javascript')

</html>
