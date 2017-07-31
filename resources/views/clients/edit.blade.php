@inject('countries', 'App\Http\Utilities\Country')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-users fa-lg fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Update Client
                </div>

                <div class="panel-body">

                    @include('partials.flash')

                    <img src="{{ $client->logo }}" alt="logo" class="img-circle img-thumbnail img-responsive center-block" height="150" width="150">

                    <br>

                    <form class="form-horizontal" method="POST" action="{{ route('clients.update', $client->id) }}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $client->name) }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                            <label for="logo" class="col-md-4 control-label">Logo</label>

                            <div class="col-md-6">
                                <input id="logo" type="text" class="form-control" name="logo" value="{{ old('logo', $client->logo) }}" required>

                                @if ($errors->has('logo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label for="country" class="col-md-4 control-label">Country</label>

                            <div class="col-md-6">
                                <select id="country" class="form-control" name="country" required>
                                    @foreach ( $countries::all() as $country => $code )
                                        @if (old('country', $client->country) == $country)
                                            <option value="{{ $country }}" selected>{{ $country }}</option>
                                        @else
                                            <option value="{{ $country }}">{{ $country }}</option>
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

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea class="form-control" rows="3" name="description" required>{{ old('description', $client->description) }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('site') ? ' has-error' : '' }}">
                            <label for="site" class="col-md-4 control-label">Site</label>

                            <div class="col-md-6">
                                <input id="site" type="text" class="form-control" name="site" value="{{ old('site', $client->site) }}" required>

                                @if ($errors->has('site'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('site') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Update
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-danger btn-block"
                                        onclick="event.preventDefault();if(confirm('Are you sure you want to delete a client?'))document.getElementById('delete-form').submit();">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </form>
                    <form id="delete-form" class="form-horizontal" method="POST" action="{{ route('clients.destroy', $client->id) }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
