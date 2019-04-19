@inject('countries', 'App\Http\Utilities\Country')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-users fa-lg fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Add Team
                </div>

                <div class="card-body">

                    @include('layouts.partials.flash')

                    <!-- Client Logo -->
                    <img src="{{ asset('storage/logos/default.png') }}"
                         alt="avatar"
                         class="rounded-circle img-thumbnail img-fluid mx-auto d-block"
                         height="150"
                         width="150">

                    <br>

                    <form method="POST"
                          action="{{ route('clients.store') }}"
                          enctype="multipart/form-data">
                        @include('clients.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
