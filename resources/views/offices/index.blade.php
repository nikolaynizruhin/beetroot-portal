@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        <i class="fas fa-building fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Offices {{ $offices->total() }}
                    </div>

                    <!-- Office List -->
                    <div class="card-body list-group">
                        @each('partials.offices.office', $offices, 'office', 'partials.offices.empty')
                    </div>

                    <!-- Pagination -->
                    <div class="text-center">
                        {{ $offices->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
