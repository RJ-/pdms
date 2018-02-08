<a class="dropdown-item" href="{{route('dean.show', $notification->data['pd']['id'])}}" style="font-size:12px">

  A new activity was posted by the HRD Director entitled <b>{{$notification->data['pd']['title']}}</b>.
  <br>
  <small>Posted: {{$notification->created_at->diffForHumans()}}</small>
</a>

{{--
@php
  $check = $notification->data['activity']['training_needs_id']
@endphp

@if ($check == 1)
  <b>Instructional Materials Development</b>
@elseif ($check == 2)
  <b>Research / Extension Related Seminar</b>
@elseif ($check == 3)
  <b>Writing and Communication Seminar</b>
@elseif ($check == 4)
  <b>Computer Literacy / Workplace Technology</b>
@elseif ($check == 5)
  <b>Human Relation / Personality Development Seminar</b>
@elseif ($check == 6)
  <b>Post Career Orientation and Direction for Retiring Employees</b>
@elseif ($check == 7)
  <b>Conflict Management / Grievance Procedures</b>
@elseif ($check == 9)
  <b>Field of Specialization Seminar</b>
@elseif ($check == 14)
  <b>Stress Management</b>
@endif --}}
