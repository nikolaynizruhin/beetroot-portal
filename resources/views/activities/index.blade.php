@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-newspaper fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        News
                    </div>

                    <div class="card-body">

                        <!-- Activity List -->
                        @include('activities.partials.list')

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $activities->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
