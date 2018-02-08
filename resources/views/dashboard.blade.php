@extends('layouts.master')

@section('title')
  Dashboard
@endsection

@section('content')
@include('includes.message-block')
<div class="container">
  <div class="row">
    <section class="row new-post">
      <div class="col-md-6 offset-md-3">
        <br><br>
        <header>
          <h3>What do you have to say?</h3>
        </header>
        <form class="" action="{{route('post.create')}}" method="post">
          <div class="md-form">
              <textarea type="text" id="body" name="body" class="md-textarea"></textarea>
              <label for="form76">Say something here</label>
          </div>
          <button class="btn btn-primary" type="submit" name="button" value="Submit">Create Post</button>
          <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
      </div>
    </section>

    <section class="row posts">
        <div class="col-md-6 offset-md-3">
          <header>
            <h3>What other people say...</h3>
          </header>
          @foreach ($posts as $post)
            <article class="post" data-postid="{{$post->id}}">
              <p>{{$post->body}}</p>
              <div class="info">
                Posted by {{$post->user->first_name}} on {{$post->created_at->diffForHumans()}}
              </div>
              <div class="interaction">
                <a href="#" class="like">{{Auth::user()->likes()->where('post_id', $post->id)->first() ?
                                            Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'}}</a> |
                <a href="#" class="like">{{Auth::user()->likes()->where('post_id', $post->id)->first() ?
                                            Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'}}</a>
                @if (Auth::user() == $post->user)
                  |
                  <a href="#" class="edit">Edit</a> |
                  <a href="{{route('post.delete', ['post_id' => $post->id])}}">Delete</a>
                @endif
              </div>
            </article>
          @endforeach
        </div>
    </section>
  </div>
</div>

{{-- <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Launch demo modal
</button> --}}

<!-- Modal -->
<div class="modal fade" id="edit-post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Edit Post</h4>
            </div>
            <!--Body-->
            <div class="modal-body">
                <form class="" action="index.html" method="post">
                  <div class="form-group">
                    <textarea class="form-control" name="post-body" id="post-body" style="padding-left: 10px">

                    </textarea>
                  </div>
                </form>
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="post-save">Save changes</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>

<script type="text/javascript">
  var token = '{{Session::token()}}';
  var urlEdit = '{{route('edit')}}';
  var urlLike = '{{route('like')}}';
</script>
@endsection
