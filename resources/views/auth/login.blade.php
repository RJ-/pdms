@extends('layouts.master')

@section('title')
  Welcome!
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
                  <i class="fa fa-sign-in"></i>  Sign In
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
        <form class="form-group" action="{{route('signin')}}" method="post">
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

  <!-- Main container-->
  <div class="container">

      <div class="divider-new">
          <h2 class="h2-responsive wow bounceIn">About us</h2>
      </div>

      <!--Section: About-->
      <section id="about" class="text-xs-center">

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit explicabo assumenda eligendi ex exercitationem harum deleniti quaerat beatae ducimus dolor voluptates magnam, reiciendis pariatur culpa tempore quibusdam quidem, saepe eius.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit explicabo assumenda eligendi ex exercitationem harum deleniti quaerat beatae ducimus dolor voluptates magnam, reiciendis pariatur culpa tempore quibusdam quidem, saepe eius.</p>

      </section>
      <!--Section: About-->

      <div class="divider-new">
          <h2 class="h2-responsive wow bounceIn">Best features</h2>
      </div>

      <!--Section: Best features-->
      <section id="best-features">

          <div class="row">

              <!--First columnn-->
              <div class="col-md-3">
                  <!--Card-->
                  <div class="card">

                      <!--Card image-->
                      <div class="view overlay hm-white-slight">
                          <img src="http://mdbootstrap.com/images/regular/city/img%20(2).jpg" class="img-fluid" alt="">
                          <a>
                              <div class="mask"></div>
                          </a>
                      </div>
                      <!--/.Card image-->

                      <!--Card content-->
                      <div class="card-block text-xs-center">
                          <!--Title-->
                          <h4 class="card-title">Card title</h4>
                          <hr>
                          <!--Text-->
                          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident fuga animi architecto dolores dicta cum quo velit.</p>
                      </div>
                      <!--/.Card content-->

                  </div>
                  <!--/.Card-->
              </div>
              <!--First columnn-->

              <!--Second columnn-->
              <div class="col-md-3">
                  <!--Card-->
                  <div class="card">

                      <!--Card image-->
                      <div class="view overlay hm-white-slight">
                          <img src="http://mdbootstrap.com/images/regular/city/img%20(3).jpg" class="img-fluid" alt="">
                          <a>
                              <div class="mask"></div>
                          </a>
                      </div>
                      <!--/.Card image-->

                      <!--Card content-->
                      <div class="card-block text-xs-center">
                          <!--Title-->
                          <h4 class="card-title">Card title</h4>
                          <hr>
                          <!--Text-->
                          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident fuga animi architecto dolores dicta cum quo velit.</p>
                      </div>
                      <!--/.Card content-->

                  </div>
                  <!--/.Card-->
              </div>
              <!--Second columnn-->

              <!--Third columnn-->
              <div class="col-md-3">
                  <!--Card-->
                  <div class="card">

                      <!--Card image-->
                      <div class="view overlay hm-white-slight">
                          <img src="http://mdbootstrap.com/images/regular/city/img%20(4).jpg" class="img-fluid" alt="">
                          <a>
                              <div class="mask"></div>
                          </a>
                      </div>
                      <!--/.Card image-->

                      <!--Card content-->
                      <div class="card-block text-xs-center">
                          <!--Title-->
                          <h4 class="card-title">Card title</h4>
                          <hr>
                          <!--Text-->
                          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident fuga animi architecto dolores dicta cum quo velit.</p>
                      </div>
                      <!--/.Card content-->

                  </div>
                  <!--/.Card-->
              </div>
              <!--Third columnn-->

              <!--Fourth columnn-->
              <div class="col-md-3">
                  <!--Card-->
                  <div class="card hoverable">

                      <!--Card image-->
                      <div class="view overlay hm-white-slight">
                          <img src="http://mdbootstrap.com/images/regular/city/img%20(8).jpg" class="img-fluid" alt="">
                          <a>
                              <div class="mask"></div>
                          </a>
                      </div>
                      <!--/.Card image-->

                      <!--Card content-->
                      <div class="card-block text-xs-center">
                          <!--Title-->
                          <h4 class="card-title">Card title</h4>
                          <hr>
                          <!--Text-->
                          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident fuga animi architecto dolores dicta cum quo velit.</p>
                      </div>
                      <!--/.Card content-->

                  </div>
                  <!--/.Card-->
              </div>
              <!--Fourth columnn-->
          </div>

      </section>
      <!--/Section: Best features-->
  </div>
  <!--/ Main container-->
@endsection
