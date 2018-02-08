<a class="dropdown-item" href="{{route('faculty.show', $notification->data['user']['id'])}}" style="font-size:13px">
  @if ($notification->data['user']['message'] != NULL)
    <b>HRD Reminder:</b> <em>{{$notification->data['user']['message']}}</em>
  @endif
  <br>
  <b>Activity title: </b>"<b>{{$notification->data['pd']['title']}}</b>
  <br>
  <small>Posted: {{$notification->created_at->diffForHumans()}}</small>
</a>
