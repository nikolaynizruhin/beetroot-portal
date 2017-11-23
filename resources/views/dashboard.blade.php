@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-tachometer fa-lg fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Dashboard
                </div>

                <div class="panel-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <a href="{{ route('users.index') }}" class="nounderline">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <p>TOTAL EMPLOYEES</p>
                                        <number-counter :count="{{ $userCount }}"></number-counter>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('clients.index') }}" class="nounderline">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <p>TOTAL CLIENTS</p>
                                        <number-counter :count="{{ $clientCount }}"></number-counter>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('offices.index') }}" class="nounderline">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <p>TOTAL OFFICES</p>
                                        <number-counter :count="{{ $officeCount }}"></number-counter>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <h3 class="text-center">TOP 5 POSITIONS</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <position-chart :positions="{{ $positions }}"></position-chart>
                        </div>
                    </div>
                    <hr>
                    <h3 class="text-center">CLIENTS</h3>
                    <hr>
                    <client-map :clients="{{ $clients }}"></client-map>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
