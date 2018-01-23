@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fas fa-tachometer-alt fa-lg fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Dashboard
                </div>

                <div class="panel-body">
                    <div class="row text-center">

                        <!-- Total Employees -->
                        <div class="col-md-4">
                            <a href="{{ route('users.index') }}" class="dashboard-link">
                                <div class="panel panel-default dashboard-panel">
                                    <div class="panel-body">
                                        <p>TOTAL EMPLOYEES</p>
                                        <h2>
                                            <counter :count="{{ $userCount }}"></counter>
                                        </h2>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Total Clients -->
                        <div class="col-md-4">
                            <a href="{{ route('clients.index') }}" class="dashboard-link">
                                <div class="panel panel-default dashboard-panel">
                                    <div class="panel-body">
                                        <p>TOTAL CLIENTS</p>
                                        <h2>
                                            <counter :count="{{ $clientCount }}"></counter>
                                        </h2>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Total Offices -->
                        <div class="col-md-4">
                            <a href="{{ route('offices.index') }}" class="dashboard-link">
                                <div class="panel panel-default dashboard-panel">
                                    <div class="panel-body">
                                        <p>TOTAL OFFICES</p>
                                        <h2>
                                            <counter :count="{{ $officeCount }}"></counter>
                                        </h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Top Positions -->
                    <hr>
                    <h3 class="text-center">TOP 5 POSITIONS</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <position-chart :positions="{{ $positions }}"></position-chart>
                        </div>
                    </div>

                    <!-- Clients -->
                    <hr>
                    <h3 class="text-center">CLIENTS</h3>
                    <hr>
                    <client-map :clients="{{ $clients }}" :api-key="'{{ config('services.googlemaps.key') }}'"></client-map>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
