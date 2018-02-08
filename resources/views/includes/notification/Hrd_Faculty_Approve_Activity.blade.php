<a class="dropdown-item" href="{{route('faculty.show', $notification->data['user']['id'])}}" style="font-size:12px">
  Your submitted activity "<b>{{$notification->data['pd']['title']}}</b>" was approve by the HRD Director.
  <br>
  <small>Posted: {{$notification->created_at->diffForHumans()}}</small>
</a>
