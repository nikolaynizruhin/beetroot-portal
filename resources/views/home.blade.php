@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-home fa-lg fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Home
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="{{ Auth::user()->avatar }}" class="img-circle img-thumbnail img-responsive" alt="avatar">
                        </div>
                        <div class="col-sm-4">
                            <h3>{{ Auth::user()->name }}</h3>
                            <h4><em>{{ Auth::user()->position }}</em></h4>
                            <p>
                                <i class="fa fa-handshake-o fa-fw" aria-hidden="true"></i>
                                &nbsp;
                                {{ Auth::user()->client->name }}
                            </p>
                            <p>
                                <i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>
                                &nbsp;
                                {{ Auth::user()->email }}
                            </p>
                            <p>
                                <i class="fa fa-birthday-cake fa-fw" aria-hidden="true"></i>
                                &nbsp;
                                {{ Auth::user()->birthday->toFormattedDateString() }}
                            </p>
                            <p>
                                <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>
                                &nbsp;
                                {{ Auth::user()->office->city }}
                            </p>
                        </div>
                        <div class="col-sm-2">
                            <br>
                            <ul class="nav nav-pills nav-stacked">
                                <li role="presentation">
                                    <a href="{{ route('users') }}">
                                        <i class="fa fa-id-card-o fa-fw" aria-hidden="true"></i>
                                        Users
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="{{ route('clients') }}">
                                        <i class="fa fa-users fa-fw" aria-hidden="true"></i>
                                        Clients
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="{{ route('offices') }}">
                                        <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>
                                        Offices
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="{{ route('users.edit', Auth::id()) }}">
                                        <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                                        Edit
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-2">
                            <br>
                            <ul class="nav nav-pills nav-stacked">
                                <li role="presentation">
                                    <a href="{{ route('users.create') }}">
                                        <i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i>
                                        User
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="{{ route('clients.create') }}">
                                        <i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i>
                                        Client
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="{{ route('offices.create') }}">
                                        <i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i>
                                        Office
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
