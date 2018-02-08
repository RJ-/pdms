@if (count($errors)>0)
  <div class="row">
    <div class="col-md-12">
      <ul>
        @foreach ($errors->all() as $error)
            <li class="alert alert-warning">{{$error}}</li>
        @endforeach
      </ul>
    </div>
  </div>
@endif

@if(Session::has('message'))
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <p class="alert alert-success">
        {{Session::get('message')}}
      </p>
    </div>
  </div>
@endif
