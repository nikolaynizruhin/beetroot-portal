@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        <i class="fas fa-id-card fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Employees {{ $users->total() }}
                    </div>

                    <div class="card-body">

                        <!-- Filters -->
                        @include('partials.users.filters')

                        <!-- User List -->
                        <div class="list-group">
                            @each('partials.users.user', $users, 'user', 'partials.users.empty')
                        </div>

                        <!-- Pagination -->
                        <div class="text-center">
                            {{ $users->appends($_GET)->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
