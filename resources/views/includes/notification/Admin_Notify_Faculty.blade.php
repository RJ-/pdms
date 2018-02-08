<a class="dropdown-item" href="{{route('faculty.show', $notification->data['user']['id'])}}" style="font-size:13px">
  @if ($notification->data['user']['message'] != NULL)
    <b>Notice:</b><b><em> {{$notification->data['pd']['title']}}</em></b><br>
    {{$notification->data['user']['message']}}
  @endif
  <br>
  <small>Posted: {{$notification->created_at->diffForHumans()}}</small>
</a>
