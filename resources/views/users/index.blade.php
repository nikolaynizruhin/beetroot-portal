@extends('layouts.app')

@section('content')
    <!-- <users :users="{{ $users }}" :user="{{ Auth::user() }}"></users> -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fas fa-id-card fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Employees
                    </div>

                    <div class="panel-body">

                        <div class="list-group">
                            @foreach ($users as $user)
                                <div class="row list-group-item">

                                    <div class="modal fade"
                                         id="userModal{{ $user->id }}"
                                         tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <button type="button"
                                                            class="close pull-right"
                                                            data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>

                                                    <img src="{{ asset('storage/'.$user->avatar) }}"
                                                         alt="Avatar"
                                                         class="img-thumbnail img-circle img-responsive center-block"
                                                         width="150"
                                                         height="150">

                                                    <h3 class="text-center">{{ $user->name }}</h3>

                                                    <h4 class="text-center"><em>{{ $user->position }}</em></h4>

                                                    <br>

                                                    <div class="row">
                                                        <div class="col-sm-5 col-sm-offset-1">
                                                            <p>
                                                                <a href="mailto:{{ $user->email }}">
                                                                    <i aria-hidden="true" class="far fa-envelope fa-fw"></i>
                                                                    &nbsp;
                                                                    {{ $user->email }}
                                                                </a>
                                                            </p>
                                                            @if ($user->phone)
                                                                <p>
                                                                    <a href="tel:{{ $user->phone }}">
                                                                        <i aria-hidden="true" class="fas fa-phone fa-fw"></i>
                                                                        &nbsp;
                                                                        {{ $user->phone }}
                                                                    </a>
                                                                </p>
                                                            @endif
                                                            <p>
                                                                <i aria-hidden="true" class="fab fa-slack-hash fa-fw"></i>
                                                                &nbsp;
                                                                {{ $user->slack }}
                                                            </p>
                                                            @if ($user->skype)
                                                                <p>
                                                                    <a href="skype:{{ $user->skype }}?userinfo">
                                                                        <i aria-hidden="true" class="fab fa-skype fa-fw"></i>
                                                                        &nbsp;
                                                                        {{ $user->skype }}
                                                                    </a>
                                                                </p>
                                                            @endif
                                                            @if ($user->github)
                                                                <p>
                                                                    <a href="https://github.com/{{ $user->github }}" target="_blank">
                                                                        <i aria-hidden="true" class="fab fa-github fa-fw"></i>
                                                                        &nbsp;
                                                                        {{ $user->github }}
                                                                    </a>
                                                                </p>
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <p>
                                                                <i aria-hidden="true" class="far fa-handshake fa-fw"></i>
                                                                &nbsp;
                                                                {{ $user->client->name }}
                                                            </p>
                                                            <p>
                                                                <i aria-hidden="true" class="fas fa-birthday-cake fa-fw"></i>
                                                                &nbsp;
                                                                {{ $user->birthday->format('d-m-Y') }}
                                                            </p>
                                                            <p>
                                                                <i aria-hidden="true" class="fas fa-map-marker-alt fa-fw"></i>
                                                                &nbsp;
                                                                {{ $user->office->city }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    @if ($user->bio)
                                                        <div class="row">
                                                            <div class="col-sm-10 col-sm-offset-1">
                                                                <p>{{ $user->bio }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <a href="#" data-toggle="modal" data-target="#userModal{{ $user->id }}">
                                            <img src="{{ asset('storage/'.$user->avatar) }}"
                                                 alt="Avatar"
                                                 class="img-thumbnail img-circle img-responsive center-block"
                                                 width="150"
                                                 height="150">
                                        </a>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-12">
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
                                            <div class="col-sm-12">
                                                <p><em>{{ $user->position }}</em></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p>
                                                    <i class="far fa-handshake fa-fw" aria-hidden="true"></i>
                                                    &nbsp;
                                                    {{ $user->client->name }}
                                                </p>
                                                <p>
                                                    <i class="far fa-envelope fa-fw" aria-hidden="true"></i>
                                                    &nbsp;
                                                    {{ $user->email }}
                                                </p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>
                                                    <i class="fas fa-birthday-cake fa-fw" aria-hidden="true"></i>
                                                    &nbsp;
                                                    {{ $user->birthday->format('d-m-Y') }}
                                                </p>
                                                <p>
                                                    <i class="fas fa-map-marker-alt fa-fw" aria-hidden="true"></i>
                                                    &nbsp;
                                                    {{ $user->office->city }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="text-center">
                            {{ $users->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
