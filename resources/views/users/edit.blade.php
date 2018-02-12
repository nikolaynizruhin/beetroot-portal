@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-cog fa-lg fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Settings
                </div>

                <div class="card-body">

                    @include('partials.flash')

                    <!-- Profile -->
                    <h4>Profile</h4>
                    <hr>

                    <!-- Profile Avatar -->
                    <img src="{{ asset('storage/' . $user->avatar) }}"
                         alt="avatar"
                         class="rounded-circle img-thumbnail img-fluid mx-auto d-block"
                         height="150"
                         width="150">

                    <br>

                    <form method="POST"
                          enctype="multipart/form-data"
                          action="{{
                              Auth::user()->is_admin ?
                                  route('users.update', $user->id) :
                                  route('profile.update', $user->id)
                          }}">
                        @method('PUT')
                        @csrf

                        @admin
                            <!-- Is Admin -->
                            <div class="form-group">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input type="checkbox"
                                                name="is_admin"
                                                class="form-check-input{{ $errors->has('is_admin') ? ' is-invalid' : '' }}"
                                                value="1"
                                                {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkbox-admin">
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
                                    </span>
                                </label>

                                <div class="col-md-6">
                                    <input id="avatar" type="file" name="avatar" class="form-control-file">

                                    @if ($errors->has('avatar'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endadmin

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
                                       value="{{ old('name', $user->name) }}"
                                       required
                                       @if ($errors->isEmpty()) autofocus @endif
                                       @employee disabled @endemployee>

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
                                       value="{{ old('email', $user->email) }}"
                                       required
                                       @employee disabled @endemployee>

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
                                <select id="position"
                                        class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}"
                                        name="position"
                                        required
                                        @employee disabled @endemployee>
                                    @foreach ( $positions as $position )
                                        @if (old('position', $user->position) == $position)
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
                                <select id="client-id"
                                        class="form-control{{ $errors->has('client_id') ? ' is-invalid' : '' }}"
                                        name="client_id"
                                        required
                                        @employee disabled @endemployee>
                                    @foreach ($clients as $id => $name)
                                        @if (old('client_id', $user->client_id) == $id)
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
                                <select id="office-id"
                                        class="form-control{{ $errors->has('office_id') ? ' is-invalid' : '' }}"
                                        name="office_id"
                                        required
                                        @employee disabled @endemployee>
                                    @foreach ($offices as $id => $city)
                                        @if (old('office_id', $user->office_id) == $id)
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
                                       value="{{ old('birthday', $user->birthday->toDateString()) }}"
                                       required
                                       @employee disabled @endemployee>

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
                                       value="{{ old('phone', $user->phone) }}">

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
                                       value="{{ old('slack', $user->slack) }}"
                                       required
                                       @employee disabled @endemployee>

                                @if ($errors->has('slack'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('slack') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Skype -->
                        <div class="form-group row">
                            <label for="skype" class="col-md-4 col-form-label text-md-right">
                                Skype
                            </label>

                            <div class="col-md-6">
                                <input id="skype"
                                       type="text"
                                       class="form-control{{ $errors->has('skype') ? ' is-invalid' : '' }}"
                                       name="skype"
                                       value="{{ old('skype', $user->skype) }}">

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
                                       value="{{ old('github', $user->github) }}">

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
                                <textarea class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }}"
                                          rows="3"
                                          name="bio">
                                    {{ old('bio', $user->bio) }}
                                </textarea>

                                @if ($errors->has('bio'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('bio') }}</strong>
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

                    <!-- Change Password -->
                    <h4>Change Password</h4>
                    <hr>

                    <form method="POST"
                          action="{{ route('users.password.update', $user->id) }}">
                        @method('PUT')
                        @csrf

                        <!-- New Password -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                New Password <small>*</small>
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

                        <!-- Confirm New Password -->
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                Confirm New Password <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <input id="password-confirm"
                                       type="password"
                                       class="form-control"
                                       name="password_confirmation"
                                       required>
                            </div>
                        </div>

                        <!-- Update Password Button -->
                        <div class="form-group row">
                            <div class="col-md-3 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Update password
                                </button>
                            </div>
                        </div>
                    </form>

                    @admin
                        <!-- Delete Account -->
                        <h4>Delete Account</h4>
                        <hr>

                        <form id="delete-form"
                              method="POST"
                              action="{{ route('users.destroy', $user->id) }}">
                            @method('DELETE')
                            @csrf

                            <div class="form-group mb-0">
                                <!-- Delete Button -->
                                <div class="col-md-3 offset-md-4">
                                    <button type="submit" class="btn btn-light btn-block"
                                            onclick="event.preventDefault();
                                                    if (confirm('Are you sure you want to delete an employee?'))
                                                    document.getElementById('delete-form').submit();">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endadmin
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
