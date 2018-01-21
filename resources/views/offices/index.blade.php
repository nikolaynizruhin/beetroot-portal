@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fas fa-building fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Offices {{ $offices->total() }}
                    </div>

                    <!-- Office List -->
                    <div class="panel-body list-group">
                        @each('partials.offices.office', $offices, 'office')
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
