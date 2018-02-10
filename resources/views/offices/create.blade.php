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
                    Add Office
                </div>

                <div class="card-body">

                    @include('partials.flash')

                    <form method="POST" action="{{ route('offices.store') }}">
                        @csrf

                        <!-- Country -->
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">
                                Country <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <select id="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" required>
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
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- City -->
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">
                                City <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <input id="city"
                                       type="text"
                                       class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
                                       name="city"
                                       value="{{ old('city') }}"
                                       required>

                                @if ($errors->has('city'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">
                                Address <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <input id="address"
                                       type="text"
                                       class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                       name="address"
                                       value="{{ old('address') }}"
                                       required>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Link -->
                        <div class="form-group row">
                            <label for="link" class="col-md-4 col-form-label text-md-right">
                                <span data-toggle="tooltip"
                                      data-placement="top"
                                      title="Google maps query (e.g., Beetroot+Academy,Kiev)">
                                    Link
                                    <small>*</small>
                                </span>
                            </label>

                            <div class="col-md-6">
                                <input id="link"
                                       type="text"
                                       class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}"
                                       name="link"
                                       value="{{ old('link') }}"
                                       required>

                                @if ($errors->has('link'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
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
