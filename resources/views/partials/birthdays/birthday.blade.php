<div class="col-md-4">
    <div class="media my-1">
        <img class="mr-3 rounded-circle" src="{{ asset('storage/'.$user->avatar) }}" alt="Avatar" width="64" height="64">
        <div class="media-body">
            <h5 class="mt-0">{{ $user->birthday->format('j F') }}</h5>
            {{ $user->name }}
        </div>
    </div>
</div>
