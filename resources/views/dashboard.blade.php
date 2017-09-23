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
                            <p>TOTAL USERS</p>
                            <number-counter :count="{{ $userCount }}"></number-counter>
                        </div>
                        <div class="col-md-4">
                            <p>TOTAL CLIENTS</p>
                            <number-counter :count="{{ $clientCount }}"></number-counter>
                        </div>
                        <div class="col-md-4">
                            <p>TOTAL OFFICES</p>
                            <number-counter :count="{{ $officeCount }}"></number-counter>
                        </div>
                    </div>
                    <hr>
                    <h3 class="text-center">POSITIONS</h3>
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
