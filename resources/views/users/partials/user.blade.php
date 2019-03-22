<div class="row mb-3">

    @include('users.partials.modal')

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
                <p class="mb-0 text-center text-md-left">
                    <strong>
                        <a class="link-unstyled" href="#" data-toggle="modal" data-target="#userModal{{ $user->id }}">
                            {{ $user->name }}
                        </a>
                    </strong>
                    &nbsp;
                    @admin
                        <a href="{{ route('users.edit', $user) }}">
                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                    @endadmin
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- Position -->
                <p class="text-center text-md-left">
                    <a class="link-unstyled" href="{{ route('users.index', ['position' => $user->position]) }}">
                        <em>{{ $user->position }}</em>
                    </a>
                </p>
            </div>
        </div>

        <!-- Skills -->
        @if ($user->tags_count)
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center text-md-left">
                        @foreach ($user->tags as $tag)
                            <a href="{{ route('users.index', ['tag' => $tag->name]) }}"
                               class="badge badge-pill badge-light">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </p>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">

                <!-- Client -->
                <p>
                    <a class="link-unstyled" href="{{ route('clients.index', ['name' => $user->client->name]) }}">
                        <i class="far fa-handshake fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        {{ $user->client->name }}
                    </a>
                </p>

                <!-- Email -->
                <p>
                    <a class="link-unstyled" href="mailto:{{ $user->email }}">
                        <i class="far fa-envelope fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        {{ $user->email }}
                    </a>
                </p>
            </div>
            <div class="col-md-6">

                <!-- Birthday -->
                <p>
                    <a class="link-unstyled" href="{{ route('birthdays.index').'#'.$user->birthday->format('F') }}">
                        <i class="fas fa-birthday-cake fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        {{ $user->birthday->format('d F Y') }}
                    </a>
                </p>

                <!-- City -->
                <p>
                    <a class="link-unstyled" href="{{ route('users.index', ['office' => $user->office->city]) }}">
                        <i class="fas fa-map-marker-alt fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        {{ $user->office->city }}
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>