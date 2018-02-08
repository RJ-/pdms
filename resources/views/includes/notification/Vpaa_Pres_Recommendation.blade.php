<a class="dropdown-item" href="{{route('president.edit', $notification->data['pd']['id'])}}" style="font-size:12px;">
  <div>
    A recommendation was made by the Vice-President for Academic Affairs
    on an activity entitled "<b>{{$notification->data['pd']['title']}}</b>".
    <br>
    <small>Posted: {{$notification->created_at->diffForHumans()}}</small>
  </div>
</a>
