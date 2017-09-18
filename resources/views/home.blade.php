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
                    <div class="row text-center">
                        <div class="col-md-4">
                            <p>TOTAL USERS</p>
                            <h2>{{ $userCount }}</h2>
                        </div>
                        <div class="col-md-4">
                            <p>TOTAL CLIENTS</p>
                            <h2>{{ $clientCount }}</h2>
                        </div>
                        <div class="col-md-4">
                            <p>TOTAL OFFICES</p>
                            <h2>{{ $officeCount }}</h2>
                        </div>
                    </div>
                    <hr>
                    <h3 class="text-center">POSITIONS</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Positions</th>
                                        <th>Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($positions as $position)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $position->position }}</td>
                                            <td>{{ $position->count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
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
