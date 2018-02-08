<a href="{{route('pdactivity.show', $notification->data['pd']['id'])}}" >
    <div>
        <strong>President</strong>
        <span class="pull-right text-muted">
            <em>{{$notification->created_at->diffForHumans()}}</em>
        </span>
    </div>
    <div>The activity entitled "<b>{{$notification->data['pd']['title']}}</b>" was approved by the President.</div>
</a>
