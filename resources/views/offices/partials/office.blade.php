<div class="row mb-3">

    <!-- Office Map -->
    <div class="col-md-8 mb-3 mb-md-0">
        <div class="embed-responsive embed-responsive-4by3">
            <iframe class="embed-responsive-item"
                    src="https://www.google.com/maps/embed/v1/place?key={{ config('services.googlemaps.key') }}&q={{ $office->link }}"
                    allowfullscreen>
            </iframe>
        </div>
    </div>

    <!-- Office Info -->
    <div class="col-md-4">
        <p>
            <i class="fas fa-map-marker-alt fa-fw" aria-hidden="true"></i>
            &nbsp;
            <strong>{{ $office->country }}, {{ $office->city }}</strong>
            @admin
                &nbsp;
                <a href="{{ route('offices.edit', $office) }}">
                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                </a>
            @endadmin
        </p>
        <p>
            <i class="fas fa-location-arrow fa-fw" aria-hidden="true"></i>
            &nbsp;
            {{ $office->address }}
        </p>
        <p>
            <a class="link-unstyled" href="{{ route('users.index', ['office' => $office->city]) }}">
                <i class="fas fa-users fa-fw" aria-hidden="true"></i>
                &nbsp;
                Beetroots
                {{ $office->users_count }}
            </a>
        </p>
        @if ($office->office_managers_count)
            <p>
                <a class="link-unstyled" href="{{ route('users.index', ['office' => $office->city, 'position' => 'Office Manager']) }}">
                    <i class="fas fa-user-tie fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Office Managers
                    {{ $office->office_managers_count }}
                </a>
            </p>
        @endif
        @if ($office->local_managers_count)
            <p>
                <a class="link-unstyled" href="{{ route('users.index', ['office' => $office->city, 'position' => 'Local Management']) }}">
                    <i class="fas fa-street-view fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Local Managers
                    {{ $office->local_managers_count }}
                </a>
            </p>
        @endif
    </div>
</div>