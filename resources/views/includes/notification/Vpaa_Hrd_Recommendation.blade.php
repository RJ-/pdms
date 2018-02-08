<a href="{{route('pdactivity.show', $notification->data['pd']['id'])}}" >
    <div>
        <strong>VPAA</strong>
        <span class="pull-right text-muted">
            <em>{{$notification->created_at->diffForHumans()}}</em>
        </span>
    </div>
    <div>A recommendation was made by the Vice-President for Academic Affairs
    on an activity entitled "<b>{{$notification->data['pd']['title']}}</b>".</div>
</a>
