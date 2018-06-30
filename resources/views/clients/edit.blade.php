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
                    Update Client
                </div>

                <div class="card-body">

                    @include('partials.flash')

                    <!-- Client Logo -->
                    <img src="{{ asset('storage/' . $client->logo) }}"
                         alt="logo"
                         class="rounded-circle img-thumbnail img-fluid mx-auto d-block"
                         height="150"
                         width="150">

                    <br>

                    <form method="POST"
                          action="{{ route('clients.update', $client) }}"
                          enctype="multipart/form-data">
                        @method('PUT')
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
                                       value="{{ old('name', $client->name) }}"
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
                                       value="{{ old('site', $client->site) }}"
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
                                    @foreach ( $countries::all() as $country )
                                        @if (old('country', $client->country) == $country)
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
                                          required>{{ old('description', $client->description) }}</textarea>

                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Update Button -->
                        <div class="form-group row">
                            <div class="col-md-3 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Delete Client -->
                    <h4>Delete Client</h4>
                    <hr>

                    <form id="delete-form"
                          method="POST"
                          action="{{ route('clients.destroy', $client) }}">
                        @method('DELETE')
                        @csrf

                        <div class="form-group row mb-0">
                            <!-- Delete Button -->
                            <div class="col-md-3 offset-md-4">
                                <button type="submit"
                                        class="btn btn-light btn-block"
                                        onclick="event.preventDefault();
                                                if (confirm('Are you sure you want to delete a client? This will remove a client and all associated employees!'))
                                                document.getElementById('delete-form').submit();">
                                    Delete
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
