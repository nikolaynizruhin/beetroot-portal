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

                    @include('partials.flash')

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
                        @csrf

                        <!-- Logo -->
                        <div class="form-group row">
                            <label for="logo" class="col-md-4 col-form-label text-md-right">
                                <span data-toggle="tooltip"
                                      data-placement="top"
                                      title="Square image (jpeg, png, bmp, gif, svg)">
                                    Logo
                                </span>
                            </label>

                            <div class="col-md-6">
                                <input class="form-control-file" id="logo" type="file" name="logo">

                                @if ($errors->has('logo'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('logo') }}
                                    </div>
                                @endif
                            </div>
                        </div>

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
                                       @if ($errors->isEmpty()) autofocus @endif>

                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Site -->
                        <div class="form-group row">
                            <label for="site" class="col-md-4 col-form-label text-md-right">
                                <span data-toggle="tooltip"
                                      data-placement="top"
                                      title="Full url with schema (e.g., https://example.com)">
                                    Site
                                    <small>*</small>
                                </span>
                            </label>

                            <div class="col-md-6">
                                <input id="site"
                                       type="text"
                                       class="form-control{{ $errors->has('site') ? ' is-invalid' : '' }}"
                                       name="site"
                                       value="{{ old('site') }}"
                                       required>

                                @if ($errors->has('site'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('site') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">
                                Country <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <select id="country"
                                        class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}"
                                        name="country"
                                        required>
                                    <option value="">Select a country...</option>
                                    @foreach ( $countries::all() as $country )
                                        @if (old('country') == $country)
                                            <option value="{{ $country }}" selected>
                                                {{ $country }}
                                            </option>
                                        @else
                                            <option value="{{ $country }}">
                                                {{ $country }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('country'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('country') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">
                                Description <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                          rows="3"
                                          name="description"
                                          required>{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
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
