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
                    Update Office
                </div>

                <div class="card-body">

                    @include('partials.flash')

                    <form method="POST"
                          action="{{ route('offices.update', $office) }}">
                        @method('PUT')
                        @csrf

                        <!-- Country -->
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">
                                Country <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <select id="country"
                                        class="form-control{{ $errors->has('country') ? ' has-error' : '' }}"
                                        name="country"
                                        required>
                                    @foreach ( $countries::all() as $country )
                                        @if (old('country', $office->country) == $country)
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
                                       class="form-control{{ $errors->has('city') ? ' has-error' : '' }}"
                                       name="city"
                                       value="{{ old('city', $office->city) }}"
                                       required
                                       autofocus>

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
                                       class="form-control{{ $errors->has('address') ? ' has-error' : '' }}"
                                       name="address"
                                       value="{{ old('address', $office->address) }}"
                                       required
                                       autofocus>

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
                                       class="form-control{{ $errors->has('link') ? ' has-error' : '' }}"
                                       name="link"
                                       value="{{ old('link', $office->link) }}"
                                       required>

                                @if ($errors->has('link'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
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

                    <!-- Delete Office -->
                    <h4>Delete Office</h4>
                    <hr>

                    <form id="delete-form"
                          method="POST"
                          action="{{ route('offices.destroy', $office) }}">
                        @method('DELETE')
                        @csrf

                        <div class="form-group mb-0">
                            <!-- Delete Button -->
                            <div class="col-md-3 offset-md-4">
                                <button type="submit"
                                        class="btn btn-light btn-block"
                                        onclick="event.preventDefault();
                                                if (confirm('Are you sure you want to delete an office? This will remove an office and all associated employees!'))
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
