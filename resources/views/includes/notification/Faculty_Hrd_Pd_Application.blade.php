@if ($notification->data['pd']['title'] != NULL)
<a href="{{route('viewSubmittedPD')}}">
    <div>
        <strong>Faculty</strong>
        <span class="pull-right text-muted">
            <em>{{$notification->created_at->diffForHumans()}}</em>
        </span>
    </div>
    <div>A Professional Development Application has been submitted.</div>
</a>
@endif
