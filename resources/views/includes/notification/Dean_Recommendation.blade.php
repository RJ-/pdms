<a class="dropdown-item" href="{{route('activity', $notification->data['pd']['id'])}}" style="font-size:12px">

  You have been tagged by your College Dean
  on an activity entitled "<b>{{$notification->data['pd']['title']}}</b>".
  <br>
  <small>Posted: {{$notification->created_at->diffForHumans()}}</small>
</a>
