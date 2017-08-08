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
                        <div class="col-sm-3">
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="img-circle img-thumbnail img-responsive" alt="avatar">
                        </div>
                        <div class="col-sm-9">
                            <h3>{{ Auth::user()->name }}</h3>
                            <h4><em>{{ Auth::user()->position }}</em></h4>
                            <div class="row">
                                <div class="col-sm-6">
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
                                </div>
                                <div class="col-sm-6">
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
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
