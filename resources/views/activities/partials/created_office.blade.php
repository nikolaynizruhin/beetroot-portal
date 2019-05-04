<div class="media">

    <!-- Location Image -->
    <img src="{{ asset('images/office.svg') }}"
         alt="Office"
         class="mr-4 img-thumbnail rounded-circle"
         width="120"
         height="120">
    <div class="media-body">
        <div class="row mb-1">

            <!-- Location -->
            <div class="col-md-8">
                New location at
                <strong>
                    {{ $activity->subject->city }},
                    {{ $activity->subject->country }}
                </strong>
                <span class="d-md-none">
                    @include('activities.partials.delete')
                </span>
            </div>
            <div class="col text-md-right">
                @date($activity->created_at)
                <span class="d-none d-md-inline ml-1">
                    @include('activities.partials.delete')
                </span>
            </div>
        </div>

        <!-- Address -->
        <p class="mb-1">
            <i class="fas fa-location-arrow fa-fw" aria-hidden="true"></i>
            &nbsp;
            {{ $activity->subject->address }}
        </p>

        <!-- Beetroots -->
        <p class="mb-1">
            <a class="text-reset" href="{{ route('users.index', ['office' => $activity->subject->city]) }}">
                <i class="fas fa-users fa-fw" aria-hidden="true"></i>
                &nbsp;
                Beetroots
                {{ $activity->subject->users->count() }}
            </a>
        </p>
    </div>
</div>