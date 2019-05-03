<div class="row mb-3">
    <div class="col-md-4 mb-md-0 mb-3">

        <!-- Logo -->
        <img src="{{ asset('storage/'.$client->logo) }}"
             alt="Logo"
             class="rounded-circle img-thumbnail img-fluid mx-auto d-block"
             width="150"
             height="150">
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">

                <!-- Name -->
                <p class="text-center text-md-left">
                    <strong>{{ $client->name }}</strong>
                    &nbsp;
                    @admin
                        <a href="{{ route('clients.edit', $client) }}">
                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                    @endadmin
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">

                <!-- Site -->
                <p>
                    <a class="text-reset" target="_blank" href="{{ $client->site }}">
                        <i class="fas fa-globe fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        @host($client->site)
                    </a>
                </p>
            </div>
            <div class="col-md-4">

                <!-- Country -->
                <p>
                    <a class="text-reset" href="{{ route('clients.index', ['country' => $client->country]) }}">
                        <i class="fas fa-map-marker-alt fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        {{ $client->country }}
                    </a>
                </p>
            </div>
            <div class="col-md-4">

                <!-- Employees -->
                <p>
                    <a class="text-reset" href="{{ route('users.index', ['client' => $client->name]) }}">
                        <i class="fas fa-users fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        {{ $client->users_count }}
                    </a>
                </p>
            </div>
        </div>

        <!-- Technologies -->
        @if ($client->tags_count)
            <div class="row">
                <div class="col-md-12">
                    <p>
                        @foreach ($client->tags as $tag)
                            <a href="{{ route('clients.index', ['tag' => $tag->name]) }}"
                               class="badge badge-pill badge-light">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </p>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">

                <!-- Description -->
                <p><em>{{ $client->description }}</em></p>
            </div>
        </div>
    </div>
</div>