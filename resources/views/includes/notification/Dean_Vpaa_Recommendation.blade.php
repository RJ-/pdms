<a class="dropdown-item" href="{{route('vpaa.edit', $notification->data['pd']['id'])}}" style="font-size:12px">

  A recommendation was made by a College Dean
  on an activity entitled "<b>{{$notification->data['pd']['title']}}</b>".
  <br>
  <small>Posted: {{$notification->created_at->diffForHumans()}}</small>
</a>
