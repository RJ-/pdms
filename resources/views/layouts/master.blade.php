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
        <link href="{{ URL::asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >

        <!-- Material Design Bootstrap -->
        <link href="{{ URL::asset('/css/mdb.min.css') }}" rel="stylesheet" type="text/css" >

        <!-- Your custom styles (optional) -->
        <link href="{{ URL::asset('/css/style.css') }}" rel="stylesheet" type="text/css" >

        <!-- Dashboard style -->
        <link href="{{ URL::asset('/css/main.css') }}" rel="stylesheet" type="text/css" >

        <link href="{{ asset('css/alertify.css') }}" rel="stylesheet" type="text/css" >

        <link href="{{ asset('css/alertify.css') }}" rel="stylesheet" type="text/css" >

    </head>
    <body>

      @include('includes.header')

      @yield('content')

    </body>
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="{{URL::asset('/js/jquery-3.1.1.min.js')}}"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{URL::asset('/js/tether.min.js')}}"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{URL::asset('/js/bootstrap.min.js')}}"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{URL::asset('/js/mdb.min.js')}}"></script>

    <!-- Personalized Modal JavaScript -->
    <script type="text/javascript" src="{{URL::asset('/js/post.js')}}"></script>

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

    @include('includes.footer')
</html>
