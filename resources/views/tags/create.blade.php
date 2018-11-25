@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-tag fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Add Skill
                    </div>

                    <div class="card-body">

                        @include('layouts.partials.flash')

                        <form method="POST" action="{{ route('tags.store') }}">
                            @include('tags.partials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
