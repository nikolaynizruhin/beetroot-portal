<div class="modal fade"
     id="userModal{{ $user->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="userModal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <button type="button"
                            class="close pull-right"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <br>

                    <!-- Avatar -->
                    <img src="{{ asset('storage/'.$user->avatar) }}"
                        alt="Avatar"
                        class="rounded-circle img-thumbnail img-fluid mx-auto d-block"
                        width="150"
                        height="150">

                    <br>

                    <!-- Name -->
                    <h4 class="text-center">{{ $user->name }}</h4>

                    <!-- Position -->
                    <h6 class="text-center"><em>{{ $user->position }}</em></h6>

                    <!-- Skills -->
                    @if ($user->tags_count)
                        <h6 class="text-center">
                            @foreach ($user->tags as $tag)
                                <span class="badge badge-pill badge-light">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </h6>
                    @endif

                    <br>

                    <div class="row">
                        <div class="col">

                            <!-- Email -->
                            <p>
                                <a class="text-reset" href="mailto:{{ $user->email }}">
                                    <i aria-hidden="true" class="far fa-envelope fa-fw"></i>
                                    &nbsp;
                                    {{ $user->email }}
                                </a>
                            </p>

                            <!-- Phone -->
                            @if ($user->phone)
                                <p>
                                    <a class="text-reset" href="tel:{{ $user->phone }}">
                                        <i aria-hidden="true" class="fas fa-phone fa-fw"></i>
                                        &nbsp;
                                        {{ $user->phone }}
                                    </a>
                                </p>
                            @endif

                            <!-- Slack -->
                            @if ($user->slack)
                                <p>
                                    <i aria-hidden="true" class="fab fa-slack-hash fa-fw"></i>
                                    &nbsp;
                                    {{ $user->slack }}
                                </p>
                            @endif

                            <!-- Facebook -->
                            @if ($user->facebook)
                                <p>
                                    <a class="text-reset" href="https://facebook.com/{{ $user->facebook }}" target="_blank">
                                        <i aria-hidden="true" class="fab fa-facebook fa-fw"></i>
                                        &nbsp;
                                        {{ $user->facebook }}
                                    </a>
                                </p>
                            @endif

                            <!-- Instagram -->
                            @if ($user->instagram)
                                <p>
                                    <a class="text-reset" href="https://instagram.com/{{ $user->instagram }}" target="_blank">
                                        <i aria-hidden="true" class="fab fa-instagram fa-fw"></i>
                                        &nbsp;
                                        {{ $user->instagram }}
                                    </a>
                                </p>
                            @endif

                            <!-- Skype -->
                            @if ($user->skype)
                                <p>
                                    <a class="text-reset" href="skype:{{ $user->skype }}?userinfo">
                                        <i aria-hidden="true" class="fab fa-skype fa-fw"></i>
                                        &nbsp;
                                        {{ $user->skype }}
                                    </a>
                                </p>
                            @endif

                            <!-- Github -->
                            @if ($user->github)
                                <p>
                                    <a class="text-reset" href="https://github.com/{{ $user->github }}" target="_blank">
                                        <i aria-hidden="true" class="fab fa-github fa-fw"></i>
                                        &nbsp;
                                        {{ $user->github }}
                                    </a>
                                </p>
                            @endif
                        </div>
                        <div class="col">

                            <!-- Client -->
                            <p>
                                <i aria-hidden="true" class="far fa-handshake fa-fw"></i>
                                &nbsp;
                                {{ $user->client->name }}
                            </p>

                            <!-- Birthday -->
                            <p>
                                <i aria-hidden="true" class="fas fa-birthday-cake fa-fw"></i>
                                &nbsp;
                                {{ $user->birthday->format('d F Y') }}
                            </p>

                            <!-- First day at Beetroot -->
                            <p>
                                <i aria-hidden="true" class="fas fa-briefcase fa-fw"></i>
                                &nbsp;
                                {{ $user->created_at->format('d F Y') }}
                            </p>

                            <!-- Office -->
                            <p>
                                <i aria-hidden="true" class="fas fa-map-marker-alt fa-fw"></i>
                                &nbsp;
                                {{ $user->office->city }}
                            </p>

                        </div>
                    </div>

                    <br>

                    <!-- Bio -->
                    @if ($user->bio)
                        <div class="row">
                            <div class="col">
                                <p>{{ $user->bio }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
