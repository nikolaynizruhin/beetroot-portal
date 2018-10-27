@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-tag fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Add Technology
                    </div>

                    <div class="card-body">

                        @include('layouts.partials.flash')

                        <form method="POST" action="{{ route('tags.store') }}">
                            @csrf

                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">
                                    Name <small>*</small>
                                </label>

                                <div class="col-md-6">
                                    <input id="name"
                                           type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required
                                           autofocus>

                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Create Button -->
                            <div class="form-group row mb-0">
                                <div class="col-md-3 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
