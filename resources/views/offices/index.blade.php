@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-building fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Locations {{ $offices->total() }}
                    </div>

                    <div class="card-body">

                        <!-- Office List -->
                        @each('partials.offices.office', $offices, 'office', 'partials.offices.empty')

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $offices->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
