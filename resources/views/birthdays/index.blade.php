@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-birthday-cake fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Birthdays
                    </div>

                    <div class="card-body">

                        <!-- Filters -->
                        @include('birthdays.partials.filters')

                        <!-- Birthday List -->
                        @include('birthdays.partials.list')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
