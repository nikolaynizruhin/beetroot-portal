@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-tags fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Technologies {{ $tags->total() }}
                    </div>

                    <div class="card-body">

                        <!-- Tag List -->
                        @include('tags.partials.list')

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $tags->appends($_GET)->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
