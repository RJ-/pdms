@extends('layouts.adminLogin')

@section('title')
  Dean:Login
@endsection

@section('content')

<!--Mask-->
<div class="view hm-black-strong">
    <!--Intro content-->
    <div class="full-bg-img flex-center" style="color: #FFF">
        <ul>
            <li>
                <h1 class="h1-responsive wow fadeInDown">Partido State University</h1>
            </li>
            <li>
                <h1 class="h1-responsive wow fadeInDown">Professional Development Management System</h1>
            </li>
            <li>
              <button type="button" class="btn btn-primary btn-lg wow fadeInDown" data-toggle="modal" data-target="#LogInModal">
                  <i class="fa fa-sign-in"></i>  Sign In as Dean
              </button>
            </li>
        </ul>
    </div>
    <!--/Intro content-->
    <div class="modal fade" id="LogInModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!--Content-->
        <div class="modal-content">
          @include('includes.message-block')
        <form class="form-group" action="{{route('dean.login.submit')}}" method="post">
            {{ csrf_field() }}
            <div class="card-block">
              {{-- header --}}
              <div class="text-xs-center">
                <h3><i class="fa fa-lock"></i>Login</h3>
                <hr class="mt-2 mb-2">
              </div>

              {{-- body --}}
              <div class="md-form">
                <i class="fa fa-user prefix"></i>
                <input type="text" class="form-control"  name="employee_id" id="employee_id" value="{{Request::old('employee_id')}}">
                <label for="employee_id">Your employee id</label>
              </div>
              <div class="md-form">
                <i class="fa fa-lock prefix"></i>
                <input type="password" class="form-control"  name="password" id="password" value="{{Request::old('password')}}">
                <label for="password">Your password</label>
              </div>

              <div class="text-xs-center">
                <button class="btn btn-primary" type="submit" name="button" value="Login">Login</button>
                <input type="hidden" name="_token" value="{{Session::token()}}">
              </div>
            </div>

        </form>
      </div>
      <!--/.Content-->
    </div>
  </div>
</div>
  <!--/.Mask-->
@endsection
