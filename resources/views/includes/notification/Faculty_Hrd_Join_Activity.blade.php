@if ($notification->data['pd']['title'] != NULL)
<a href="{{route('pdactivity.show', $notification->data['pd']['id'])}}">
    <div>
        <strong>Faculty</strong>
        <span class="pull-right text-muted">
            <em>{{$notification->created_at->diffForHumans()}}</em>
        </span>
    </div>
    <div>The activity <b>{{$notification->data['pd']['title']}}</b> has a new interested participant.</div>
</a>
@endif
