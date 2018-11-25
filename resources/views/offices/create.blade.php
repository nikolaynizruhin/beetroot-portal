@inject('countries', 'App\Http\Utilities\Country')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-building fa-lg fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Add Location
                </div>

                <div class="card-body">

                    @include('layouts.partials.flash')

                    <form method="POST" action="{{ route('offices.store') }}">
                        @csrf
                        @include('offices.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
