<div class="row">
    <div class="col-sm-4">

        <!-- Logo -->
        <img src="{{ asset('storage/'.$client->logo) }}"
             alt="Logo"
             class="rounded-circle img-thumbnail img-fluid mx-auto d-block"
             width="150"
             height="150">
    </div>
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-12">

                <!-- Name -->
                <p>
                    <strong>{{ $client->name }}</strong>
                    &nbsp;
                    @admin
                        <a href="{{ route('clients.edit', $client->id) }}">
                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                    @endadmin
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">

                <!-- Site -->
                <p>
                    <a target="_blank" href="{{ $client->site }}">
                        <i class="fas fa-globe fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        {{ $client->site }}
                    </a>
                </p>
            </div>
            <div class="col-sm-6">

                <!-- Country -->
                <p>
                    <i class="fas fa-map-marker-alt fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    {{ $client->country }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">

                <!-- Description -->
                <p><em>{{ $client->description }}</em></p>
            </div>
        </div>
    </div>
</div>