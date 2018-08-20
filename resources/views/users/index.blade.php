@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-id-card fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Beetroots {{ $users->total() }}
                    </div>

                    <div class="card-body">

                        <!-- Filters -->
                        @include('users.partials.filters')

                        <!-- User List -->
                        @each('users.partials.user', $users, 'user', 'users.partials.empty')

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
