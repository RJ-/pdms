<a href="{{route('pdactivity.show', $notification->data['pd']['id'])}}" >
    <div>
        <strong>President</strong>
        <span class="pull-right text-muted">
            <em>{{$notification->created_at->diffForHumans()}}</em>
        </span>
    </div>
    <div>Recommended participants were approved by the President
    on an activity entitled "<b>{{$notification->data['pd']['title']}}</b>".</div>
</a>
