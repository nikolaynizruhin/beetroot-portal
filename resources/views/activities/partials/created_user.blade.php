@include('users.partials.modal', ['user' => $activity->subject])

<div class="media">

    <!-- Avatar -->
    <a href="#" data-toggle="modal" data-target="#userModal{{ $activity->subject->id }}">
        <img src="{{ asset('storage/'.$activity->subject->avatar) }}"
             alt="Avatar"
             class="mr-4 rounded-circle"
             width="120"
             height="120">
    </a>

    <div class="media-body">
        <div class="row mb-1">

            <!-- User And Client Name -->
            <div class="col-md-8">
                <a class="text-reset" href="#" data-toggle="modal" data-target="#userModal{{ $activity->subject->id }}">
                    <strong>{{ $activity->subject->name }}</strong>
                </a>
                joined
                <a class="text-reset" href="{{ route('clients.index', ['name' => $activity->subject->client->name]) }}">
                    <strong>{{ $activity->subject->client->name }}</strong>
                </a>
                <span class="d-md-none">
                    @include('activities.partials.delete')
                </span>
            </div>

            <!-- Date -->
            <div class="col text-md-right">
                {{ $activity->created_at->format('d F Y') }}
                <span class="d-none d-md-inline ml-1">
                    @include('activities.partials.delete')
                </span>
            </div>
        </div>

        <!-- Position -->
        <p class="mb-1">
            <a class="text-reset" href="{{ route('users.index', ['position' => $activity->subject->position]) }}">
                <em>{{ $activity->subject->position }}</em>
            </a>
        </p>

        <!-- City -->
        <p class="mb-1">
            <a class="text-reset" href="{{ route('users.index', ['office' => $activity->subject->office->city]) }}">
                <i class="fas fa-map-marker-alt fa-fw" aria-hidden="true"></i>
                {{ $activity->subject->office->city }}
            </a>
        </p>
    </div>
</div>