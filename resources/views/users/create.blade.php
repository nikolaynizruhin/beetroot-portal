@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-id-card-o fa-lg fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Add Employee
                </div>

                <div class="panel-body">

                    @include('partials.flash')

                    <img src="{{ asset('storage/avatars/default.jpg') }}" alt="avatar" class="img-circle img-thumbnail img-responsive center-block" height="150" width="150">

                    <br>

                    <form class="form-horizontal" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('is_admin') ? ' has-error' : '' }}">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }}> Admin
                                    </label>

                                    @if ($errors->has('is_admin'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('is_admin') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                            <label for="avatar" class="col-md-4 control-label">Avatar <small>*</small></label>

                            <div class="col-md-6">
                                <input id="avatar" type="file" name="avatar" required>

                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name <small>*</small></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email <small>*</small></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                            <label for="position" class="col-md-4 control-label">Position <small>*</small></label>

                            <div class="col-md-6">
                                <select id="position" class="form-control" name="position" required>
                                    @foreach ( $positions as $position )
                                        @if (old('position') == $position)
                                            <option value="{{ $position }}" selected>{{ $position }}</option>
                                        @else
                                            <option value="{{ $position }}">{{ $position }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('position'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('client_id') ? ' has-error' : '' }}">
                            <label for="client-id" class="col-md-4 control-label">Client <small>*</small></label>

                            <div class="col-md-6">
                                <select id="client-id" class="form-control" name="client_id" required>
                                    @foreach ($clients as $id => $name)
                                        @if (old('client_id') == $id)
                                            <option value="{{ $id }}" selected>{{ $name }}</option>
                                        @else
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('client_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('client_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('office_id') ? ' has-error' : '' }}">
                            <label for="office-id" class="col-md-4 control-label">Office <small>*</small></label>

                            <div class="col-md-6">
                                <select id="office-id" class="form-control" name="office_id" required>
                                    @foreach ($offices as $id => $city)
                                        @if (old('office_id') == $id)
                                            <option value="{{ $id }}" selected>{{ $city }}</option>
                                        @else
                                            <option value="{{ $id }}">{{ $city }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('office_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('office_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            <label for="birthday" class="col-md-4 control-label">Birthday <small>*</small></label>

                            <div class="col-md-6">
                                <input id="birthday" type="date" class="form-control" name="birthday" value="{{ old('birthday') }}" required>

                                @if ($errors->has('birthday'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('slack') ? ' has-error' : '' }}">
                            <label for="slack" class="col-md-4 control-label">Slack <small>*</small></label>

                            <div class="col-md-6">
                                <input id="slack" type="text" class="form-control" name="slack" value="{{ old('slack') }}" required>

                                @if ($errors->has('slack'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slack') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('skype') ? ' has-error' : '' }}">
                            <label for="skype" class="col-md-4 control-label">Skype</label>

                            <div class="col-md-6">
                                <input id="skype" type="text" class="form-control" name="skype" value="{{ old('skype') }}">

                                @if ($errors->has('skype'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('skype') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('github') ? ' has-error' : '' }}">
                            <label for="github" class="col-md-4 control-label">Github</label>

                            <div class="col-md-6">
                                <input id="github" type="text" class="form-control" name="github" value="{{ old('github') }}">

                                @if ($errors->has('github'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('github') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
                            <label for="bio" class="col-md-4 control-label">Bio</label>

                            <div class="col-md-6">
                                <textarea class="form-control" rows="3" name="bio">{{ old('bio') }}</textarea>

                                @if ($errors->has('bio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bio') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password <small>*</small></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password <small>*</small></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-4">
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
