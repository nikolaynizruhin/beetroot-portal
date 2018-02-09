@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    <i class="fas fa-id-card fa-lg fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Add Employee
                </div>

                <div class="card-body">

                    @include('partials.flash')

                    <!-- Profile Avatar -->
                    <img src="{{ asset('storage/avatars/default.png') }}"
                         alt="avatar"
                         class="rounded-circle img-thumbnail img-fluid mx-auto d-block"
                         height="150"
                         width="150">

                    <br>

                    <form method="POST"
                          action="{{ route('users.store') }}"
                          enctype="multipart/form-data">
                        @csrf

                        <!-- Is Admin -->
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"
                                               name="is_admin"
                                               value="1"
                                               {{ old('is_admin') ? 'checked' : '' }}>
                                        Admin
                                    </label>

                                    @if ($errors->has('is_admin'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('is_admin') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Avatar -->
                        <div class="form-group row">
                            <label for="avatar" class="col-md-4 col-form-label text-md-right">
                                <span data-toggle="tooltip"
                                      data-placement="top"
                                      title="Square image (jpeg, png, bmp, gif, svg)">
                                    Avatar
                                    <small>*</small>
                                </span>
                            </label>

                            <div class="col-md-6">
                                <input class="form-control-file" id="avatar" type="file" name="avatar" required>

                                @if ($errors->has('avatar'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                                <span data-toggle="tooltip"
                                      data-placement="top"
                                      title="Full name (e.g., John Doe)">
                                    Name
                                    <small>*</small>
                                </span>
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
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                Email <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <input id="email"
                                       type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Position -->
                        <div class="form-group row">
                            <label for="position" class="col-md-4 col-form-label text-md-right">
                                Position <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <select id="position" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position" required>
                                    <option value="">Select a position...</option>
                                    @foreach ( $positions as $position )
                                        @if (old('position') == $position)
                                            <option value="{{ $position }}" selected>
                                                {{ $position }}
                                            </option>
                                        @else
                                            <option value="{{ $position }}">
                                                {{ $position }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('position'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Client -->
                        <div class="form-group row">
                            <label for="client-id" class="col-md-4 col-form-label text-md-right">
                                Client <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <select id="client-id" class="form-control{{ $errors->has('client_id') ? ' is-invalid' : '' }}" name="client_id" required>
                                    <option value="">Select a client...</option>
                                    @foreach ($clients as $id => $name)
                                        @if (old('client_id') == $id)
                                            <option value="{{ $id }}" selected>
                                                {{ $name }}
                                            </option>
                                        @else
                                            <option value="{{ $id }}">
                                                {{ $name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('client_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('client_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Office -->
                        <div class="form-group row">
                            <label for="office-id" class="col-md-4 col-form-label text-md-right">
                                Office <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <select id="office-id" class="form-control{{ $errors->has('office_id') ? ' is-invalid' : '' }}" name="office_id" required>
                                    <option value="">Select an office...</option>
                                    @foreach ($offices as $id => $city)
                                        @if (old('office_id') == $id)
                                            <option value="{{ $id }}" selected>
                                                {{ $city }}
                                            </option>
                                        @else
                                            <option value="{{ $id }}">
                                                {{ $city }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('office_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('office_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Birthday -->
                        <div class="form-group row">
                            <label for="birthday" class="col-md-4 col-form-label text-md-right">
                                Birthday <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <input id="birthday"
                                       type="date"
                                       class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"
                                       name="birthday"
                                       value="{{ old('birthday') }}"
                                       required>

                                @if ($errors->has('birthday'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>

                            <div class="col-md-6">
                                <input id="phone"
                                       type="text"
                                       class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                       name="phone"
                                       value="{{ old('phone') }}">

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Slack -->
                        <div class="form-group row">
                            <label for="slack" class="col-md-4 col-form-label text-md-right">
                                Slack <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <input id="slack"
                                       type="text"
                                       class="form-control{{ $errors->has('slack') ? ' is-invalid' : '' }}"
                                       name="slack"
                                       value="{{ old('slack') }}"
                                       required>

                                @if ($errors->has('slack'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('slack') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Skype -->
                        <div class="form-group row">
                            <label for="skype" class="col-md-4 col-form-label text-md-right">Skype</label>

                            <div class="col-md-6">
                                <input id="skype"
                                       type="text"
                                       class="form-control{{ $errors->has('skype') ? ' is-invalid' : '' }}"
                                       name="skype"
                                       value="{{ old('skype') }}">

                                @if ($errors->has('skype'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('skype') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Github -->
                        <div class="form-group row">
                            <label for="github" class="col-md-4 col-form-label text-md-right">
                                <span data-toggle="tooltip"
                                      data-placement="top"
                                      title="Github username">
                                    Github
                                </span>
                            </label>

                            <div class="col-md-6">
                                <input id="github"
                                       type="text"
                                       class="form-control{{ $errors->has('github') ? ' is-invalid' : '' }}"
                                       name="github"
                                       value="{{ old('github') }}">

                                @if ($errors->has('github'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('github') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Bio -->
                        <div class="form-group row">
                            <label for="bio" class="col-md-4 col-form-label text-md-right">Bio</label>

                            <div class="col-md-6">
                                <textarea class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }}" rows="3" name="bio">{{ old('bio') }}</textarea>

                                @if ($errors->has('bio'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('bio') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                Password <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <input id="password"
                                       type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password"
                                       required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                Confirm Password <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <input id="password-confirm"
                                       type="password"
                                       class="form-control"
                                       name="password_confirmation"
                                       required>
                            </div>
                        </div>

                        <!-- Create Button -->
                        <div class="form-group row mb-0">
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
