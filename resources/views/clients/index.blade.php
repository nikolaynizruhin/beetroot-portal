@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        <i class="fas fa-users fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Clients {{ $clients->total() }}
                    </div>

                    <div class="card-body">

                        <!-- Filters -->
                        @include('partials.clients.filters')

                        <!-- Client List -->
                        <div class="list-group">
                            @each('partials.clients.client', $clients, 'client', 'partials.clients.empty')
                        </div>

                        <!-- Pagination -->
                        <div class="text-center">
                            {{ $clients->appends($_GET)->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
