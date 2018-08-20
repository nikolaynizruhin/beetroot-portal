<div class="col-md-4">

    @include('users.partials.modal')

    <div class="media my-1">

        <!-- Avatar -->
        <a href="#" data-toggle="modal" data-target="#userModal{{ $user->id }}">
            <img class="mr-3 rounded-circle img-thumbnail" src="{{ asset('storage/'.$user->avatar) }}" alt="Avatar" width="64" height="64">
        </a>

        <div class="media-body">

            <!-- Birthday -->
            <h5 class="mt-0">{{ $user->birthday->format('j F') }}</h5>

            <!-- Name -->
            <a class="link-unstyled" href="#" data-toggle="modal" data-target="#userModal{{ $user->id }}">
                {{ $user->name }}
            </a>
        </div>
    </div>
</div>
