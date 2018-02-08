@extends('layouts.master')

@section('title')
  Be right back.
@endsection

@section('content')

<!--Mask-->
<div class="view hm-black-strong">
    <!--Intro content-->
    <div class="full-bg-img flex-center" style="color: #FFF">
        <ul>
            <li>
                <h1 class="h1-responsive wow fadeIn" style="font-size: 72px;">404 Error! <span>Page Not Found</span></h1>
            </li>
            <li>
                <p class="p-responsive wow fadeIn" style="font-size: 28px;">For Some Reason The Page You Requested Could Not Be Found On Our Server</p>
            </li>
            <li>
              <a href="javascript:history.go(-1)">
                  <button type="button" name="button" class="btn btn-primary btn-lg wow fadeIn">
                    <i class="fa fa-angle-double-left"></i> Go Back
                  </button>
                </a>
            </li>
        </ul>
    </div>

</div>
  <!--/.Mask-->
@endsection
