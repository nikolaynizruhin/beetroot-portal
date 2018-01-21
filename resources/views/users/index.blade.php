@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fas fa-id-card fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Employees {{ $users->total() }}
                    </div>

                    <div class="panel-body">

                        <!-- Filters -->
                        @include('partials.users.filters')

                        <!-- User List -->
                        <div class="list-group">
                            @each('partials.users.user', $users, 'user')
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
