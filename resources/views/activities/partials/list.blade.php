@forelse ($activities as $activity)
    @include("activities.partials.{$activity->name}")

    @if (! $loop->last)
        <hr>
    @endif
@empty
    <p>No Activities</p>
@endforelse