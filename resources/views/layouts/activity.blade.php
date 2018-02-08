<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}">

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" >

        <!-- Material Design Bootstrap -->
        <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet" type="text/css" >

        <!-- Your custom styles (optional) -->
        <link href="{{ asset('css/mainActivity.css') }}" rel="stylesheet" type="text/css" >

        <!-- Dashboard style -->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" >

        <link href="{{ asset('css/alertify.css') }}" rel="stylesheet" type="text/css" >

        <!-- sidebar style -->
        <link href="{{ asset('css/sidebarstyle.css') }}" rel="stylesheet" type="text/css" >


        @yield('stylesheets')

        <style media="screen">
        .view {
            background-image: url("https://mdbootstrap.com/img/Photos/Horizontal/Nature/full page/img(11).jpg");
            background-color: #4285f4;
            background-image: url("paper.gif");
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        .flex-center {
            color: #fff;
            align-items:flex-end;
        }
        #toTop{
        	position: fixed;
        	bottom: 210px;
        	left: 5px;
        	cursor: pointer;
        	display: none;
        }
        </style>
        @include('includes.header')

    </head>
    <body>

      @yield('content')

    </body>
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{ asset('js/tether.min.js') }}"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>

    <!-- Personalized Modal JavaScript -->
    <script type="text/javascript" src="{{ asset('js/post.js') }}"></script>


    <script type="text/javascript" src="{{ asset('js/notification.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/sidebarWbutton.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/alertify.js') }}"></script>

    <!-- Animations init-->
    <script>
        new WOW().init();
    </script>

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
    @endif

    @yield('javascript')

    @include('includes.footer')
</html>
