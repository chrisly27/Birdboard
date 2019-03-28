@if (count($activity->changes['after']) == 1)
    <b>{{ $activity->user->name }}</b> updated the {{ key($activity->changes['after']) }} of the project
@else
    <b>{{ $activity->user->name }}</b> updated the project
@endif