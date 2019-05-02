<div class="media">

    <!-- Logo -->
    <img src="{{ asset('storage/'.$activity->subject->logo) }}"
         alt="Logo"
         class="mr-4 rounded-circle"
         width="120"
         height="120">
    <div class="media-body">
        <div class="row mb-1">

            <!-- Name -->
            <div class="col-md-8">
                New team:
                <a class="text-reset" href="{{ route('clients.index', ['name' => $activity->subject->name]) }}">
                    <strong>{{ $activity->subject->name }}</strong>
                </a>
                <span class="d-md-none">
                    @include('activities.partials.delete')
                </span>
            </div>
            <div class="col text-md-right">
                {{ $activity->created_at->format('d F Y') }}
                <span class="d-none d-md-inline ml-1">
                    @include('activities.partials.delete')
                </span>
            </div>
        </div>

        <!-- Site -->
        <p class="mb-1">
            <a class="text-reset" target="_blank" href="{{ $activity->subject->site }}">
                <i class="fas fa-globe fa-fw" aria-hidden="true"></i>
                &nbsp;
                @host($activity->subject->site)
            </a>
        </p>

        <!-- Country -->
        <p class="mb-1">
            <a class="text-reset" href="{{ route('clients.index', ['country' => $activity->subject->country]) }}">
                <i class="fas fa-map-marker-alt fa-fw" aria-hidden="true"></i>
                &nbsp;
                {{ $activity->subject->country }}
            </a>
        </p>
    </div>
</div>