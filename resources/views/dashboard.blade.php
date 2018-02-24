@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-tachometer-alt fa-lg fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Dashboard
                </div>

                <div class="card-body">
                    <div class="row text-center">

                        <!-- Total Employees -->
                        <div class="col-md-4">
                            <a href="{{ route('users.index') }}" class="link-dashboard">
                                <div class="card card-dashboard mb-2">
                                    <div class="card-body">
                                        <p class="card-text">TOTAL EMPLOYEES</p>
                                        <h2 class="card-title">
                                            <counter :count="{{ $userCount }}"></counter>
                                        </h2>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Total Clients -->
                        <div class="col-md-4">
                            <a href="{{ route('clients.index') }}" class="link-dashboard">
                                <div class="card card-dashboard mb-2">
                                    <div class="card-body">
                                        <p class="card-text">TOTAL CLIENTS</p>
                                        <h2 class="card-title">
                                            <counter :count="{{ $clientCount }}"></counter>
                                        </h2>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Total Offices -->
                        <div class="col-md-4">
                            <a href="{{ route('offices.index') }}" class="link-dashboard">
                                <div class="card card-dashboard mb-2">
                                    <div class="card-body">
                                        <p class="card-text">TOTAL OFFICES</p>
                                        <h2 class="card-title">
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
                            <positions-chart :positions="{{ $positions }}"></positions-chart>
                        </div>
                    </div>

                    <!-- Clients -->
                    <hr>
                    <h3 class="text-center">CLIENTS</h3>
                    <hr>
                    <clients-map :clients="{{ $clients }}" :api-key="'{{ config('services.googlemaps.key') }}'"></clients-map>

                    <!-- Offices -->
                    <hr>
                    <h3 class="text-center">OFFICES</h3>
                    <hr>
                    <offices-map :offices="{{ $offices }}" :api-key="'{{ config('services.googlemaps.key') }}'"></offices-map>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
