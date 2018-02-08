@extends('layouts.activity')

@section('title')
    Research
@endsection

@section('content')
<style media="screen">
.view {
    background-color: #ffbb33;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.flex-center {
    color: #fff;
    align-items:flex-end;
}
</style>
<div class="view">
    <!--Intro content-->
    <div class="full-bg-img flex-center"><br>
        <ul>
            <li>
                <h1 class="h1-responsive wow fadeInDown">Research Presentation on Educational Technology</h1>
            </li>
            <li class="wow fadeInUp" data-wow-delay="0.4s">
                    <a class="btn btn-white-outline btn-lg"><i class="fa fa-user left"></i> Submit Application</a>
                    <a class="btn btn-white-outline btn-lg"><i class="fa fa-book left"></i>Interested</a>
            </li>
        </ul>
    </div>
</div>
    <div class="container">
      <br>
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <h4 class="card-header warning-color white-text">Description</h4>
            <div class="card-block">
              <p class="card-text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse et ipsum hendrerit,
                dictum orci sed, interdum nisl. Praesent id iaculis nulla. In a scelerisque tortor.
                Vivamus at libero venenatis, pharetra mauris ut, elementum magna. Nulla facilisi.
                Morbi luctus, sapien tincidunt efficitur commodo, libero massa hendrerit nulla, a ornare
                tellus lacus et massa. Nulla at rhoncus lacus, eu vestibulum leo. Maecenas pharetra odio
                nibh, eget mollis felis ultrices quis. Ut hendrerit orci ac quam luctus aliquet.
                Aenean tincidunt bibendum mi, vitae consequat nulla. Cras ultrices sollicitudin massa at
                rhoncus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
              </p>
            </div>
          </div>

          <div class="card">
            <h4 class="card-header warning-color white-text">Details</h4>
            <table class="table">
              <tr>
                <th> <i class="fa fa-map-marker prefix"></i> Where:</th>
                <td>University of the Philippines, Diliman, Quezon City</td>
              </tr>
              <tr>
                <th> <i class="fa fa-calendar prefix"></i> When:</th>
                <td>January 4, 2017</td>
              </tr>
              <tr>
                <th> <i class="fa fa-thumb-tack prefix"></i> Interested:</th>
                <td>20 faculties are interested</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <h4 class="card-header warning-color white-text">Submitted Applications</h4>
            <table class="table">
              <tr>
                <th> <i class="fa fa-user prefix"></i> Username</th>
              </tr>
              <tr>
                <td> title of application</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  {{-- <div class="streak">
    <div class="flex-center">
      <ul>
        <li><h2 class="h2-responsive wow fadeIn">Hellow World</h2></li>
      </ul>
    </div>
  </div> --}}
  @endsection
