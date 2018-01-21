@inject('countries', 'App\Http\Utilities\Country')

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fas fa-users fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Clients {{ $clients->total() }}
                    </div>

                    <div class="panel-body">

                        <!-- Filters -->
                        @include('partials.clients.filters')

                        <!-- Client List -->
                        <div class="list-group">
                            @each('partials.clients.client', $clients, 'client')
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
