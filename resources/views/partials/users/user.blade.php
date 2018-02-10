<div class="row mb-3">

    @include('partials.users.modal')

    <div class="col-md-4">

        <!-- Avatar -->
        <a href="#" data-toggle="modal" data-target="#userModal{{ $user->id }}">
            <img src="{{ asset('storage/'.$user->avatar) }}"
                 alt="Avatar"
                 class="rounded-circle img-thumbnail img-fluid mx-auto d-block"
                 width="150"
                 height="150">
        </a>
    </div>

    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">

                <!-- Name -->
                <p>
                    <strong>
                        <a href="#" data-toggle="modal" data-target="#userModal{{ $user->id }}">
                            {{ $user->name }}
                        </a>
                    </strong>
                    &nbsp;
                    @admin
                        <a href="{{ route('users.edit', $user->id) }}">
                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                    @endadmin
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- Position -->
                <p><em>{{ $user->position }}</em></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">

                <!-- Client -->
                <p>
                    <i class="far fa-handshake fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    {{ $user->client->name }}
                </p>

                <!-- Email -->
                <p>
                    <i class="far fa-envelope fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    {{ $user->email }}
                </p>
            </div>
            <div class="col-md-6">

                <!-- Birthday -->
                <p>
                    <i class="fas fa-birthday-cake fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    {{ $user->birthday->format('d-m-Y') }}
                </p>

                <!-- City -->
                <p>
                    <i class="fas fa-map-marker-alt fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    {{ $user->office->city }}
                </p>
            </div>
        </div>
    </div>
</div>