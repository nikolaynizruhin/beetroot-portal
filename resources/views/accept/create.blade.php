@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-clipboard-check fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Accept Privacy Policy
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('accept.store') }}">
                            @include('accept.partials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
