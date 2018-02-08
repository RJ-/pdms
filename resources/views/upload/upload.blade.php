@extends('layouts.master')

@section('title')
  Welcome!
@endsection

@section('content')
  <br><br><br><br>
<div class="row">
  <div class="col-lg-4">
    <h1>Upload file</h1>
    <form class="" action="/store" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <input type="file" name="image">
      <br>
      <input type="submit" name="" value="Upload">
    </form>
  </div>
</div>


@endsection
