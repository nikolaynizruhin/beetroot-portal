@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-id-card fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Employees {{ $users->total() }}
                    </div>

                    <div class="card-body">

                        <!-- Filters -->
                        @include('partials.users.filters')

                        <!-- User List -->
                        @each('partials.users.user', $users, 'user', 'partials.users.empty')

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $users->appends($_GET)->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
