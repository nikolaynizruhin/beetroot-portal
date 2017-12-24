@inject('countries', 'App\Http\Utilities\Country')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fas fa-building fa-lg fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Update Office
                </div>

                <div class="panel-body">

                    @include('partials.flash')

                    <form class="form-horizontal"
                          method="POST"
                          action="{{ route('offices.update', $office->id) }}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <!-- Country -->
                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label for="country" class="col-md-4 control-label">
                                Country <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <select id="country" class="form-control" name="country" required>
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
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- City -->
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">
                                City <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <input id="city"
                                       type="text"
                                       class="form-control"
                                       name="city"
                                       value="{{ old('city', $office->city) }}"
                                       required
                                       autofocus>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">
                                Address <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <input id="address"
                                       type="text"
                                       class="form-control"
                                       name="address"
                                       value="{{ old('address', $office->address) }}"
                                       required
                                       autofocus>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Link -->
                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                            <label for="link" class="col-md-4 control-label">
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
                                       class="form-control"
                                       name="link"
                                       value="{{ old('link', $office->link) }}"
                                       required>

                                @if ($errors->has('link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Update Button -->
                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-4">
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
                          class="form-horizontal"
                          method="POST"
                          action="{{ route('offices.destroy', $office->id) }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <!-- Delete Button -->
                            <div class="col-md-3 col-md-offset-4">
                                <button type="submit"
                                        class="btn btn-default btn-block"
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
