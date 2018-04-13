<div class="row mb-3">

    <!-- Office Map -->
    <div class="col-md-8">
        <iframe width="100%"
                height="350"
                frameborder="0"
                style="border:0"
                src="https://www.google.com/maps/embed/v1/place?key={{ config('services.googlemaps.key') }}&q={{ $office->link }}"
                allowfullscreen>
        </iframe>
    </div>

    <!-- Office Info -->
    <div class="col-md-4">
        <p>
            <i class="fas fa-map-marker-alt fa-fw" aria-hidden="true"></i>
            &nbsp;
            <strong>{{ $office->country }}, {{ $office->city }}</strong>
            @admin
                &nbsp;
                <a href="{{ route('offices.edit', $office->id) }}">
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
            <a href="{{ route('users.index', ['office' => $office->city]) }}">
                <i class="fas fa-users fa-fw" aria-hidden="true"></i>
                &nbsp;
                {{ $office->users_count }}
            </a>
        </p>
    </div>
</div>