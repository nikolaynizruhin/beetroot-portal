@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-id-card fa-lg fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Add Beetroot
                </div>

                <div class="card-body">

                    @include('layouts.partials.flash')

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
                                <div class="form-check">
                                    <input class="form-check-input{{ $errors->has('is_admin') ? ' is-invalid' : '' }}"
                                           type="checkbox"
                                           id="checkbox-admin"
                                           name="is_admin"
                                           value="1"
                                           {{ old('is_admin') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="checkbox-admin">
                                        Admin
                                    </label>

                                    @if ($errors->has('is_admin'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('is_admin') }}
                                        </div>
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
                                <input class="form-control-file" id="avatar" type="file" name="avatar">

                                @if ($errors->has('avatar'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('avatar') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Gender -->
                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-md-4 text-md-right pt-0">
                                    Gender <small>*</small>
                                </legend>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input{{ $errors->has('gender') ? ' is-invalid' : '' }}"
                                               type="radio"
                                               name="gender"
                                               id="gender-male"
                                               value="male"
                                               checked
                                               required>
                                        <label class="form-check-label" for="gender-male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input{{ $errors->has('gender') ? ' is-invalid' : '' }}"
                                               type="radio"
                                               name="gender"
                                               id="gender-female"
                                               value="female"
                                               required>
                                        <label class="form-check-label" for="gender-female">
                                            Female
                                        </label>

                                        @if ($errors->has('gender'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('gender') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </fieldset>

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
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
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
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
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
                                        required>
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
                                    <div class="invalid-feedback">
                                        {{ $errors->first('position') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Client -->
                        <div class="form-group row">
                            <label for="client-id" class="col-md-4 col-form-label text-md-right">
                                Team <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <select id="client-id"
                                        class="form-control{{ $errors->has('client_id') ? ' is-invalid' : '' }}"
                                        name="client_id"
                                        required>
                                    <option value="">Select a team...</option>
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
                                    <div class="invalid-feedback">
                                        {{ $errors->first('client_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Office -->
                        <div class="form-group row">
                            <label for="office-id" class="col-md-4 col-form-label text-md-right">
                                Location <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <select id="office-id"
                                        class="form-control{{ $errors->has('office_id') ? ' is-invalid' : '' }}"
                                        name="office_id"
                                        required>
                                    <option value="">Select a location...</option>
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
                                    <div class="invalid-feedback">
                                        {{ $errors->first('office_id') }}
                                    </div>
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
                                    <div class="invalid-feedback">
                                        {{ $errors->first('birthday') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- First Day -->
                        <div class="form-group row">
                            <label for="created_at" class="col-md-4 col-form-label text-md-right">
                                <span data-toggle="tooltip"
                                      data-placement="top"
                                      title="First day at Beetroot">
                                    First Day
                                    <small>*</small>
                                </span>
                            </label>

                            <div class="col-md-6">
                                <input id="created_at"
                                       type="date"
                                       class="form-control{{ $errors->has('created_at') ? ' is-invalid' : '' }}"
                                       name="created_at"
                                       value="{{ old('created_at', now()->toDateString()) }}"
                                       required>

                                @if ($errors->has('created_at'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('created_at') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Skills -->
                        <div class="form-group row">
                            <label for="tags" class="col-md-4 col-form-label text-md-right">
                                Skills
                            </label>

                            <div class="col-md-6">
                                <select id="tags"
                                        class="form-control{{ $errors->has('tags') ? ' is-invalid' : '' }}"
                                        name="tags[]"
                                        multiple="multiple">
                                    @foreach ($tags as $tag)
                                        @if (collect(old('tags'))->contains($tag->id))
                                            <option value="{{ $tag->id }}" selected>
                                                {{ $tag->name }}
                                            </option>
                                        @else
                                            <option value="{{ $tag->id }}">
                                                {{ $tag->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('tags'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('tags') }}
                                    </div>
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
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Slack -->
                        <div class="form-group row">
                            <label for="slack" class="col-md-4 col-form-label text-md-right">
                                Slack
                            </label>

                            <div class="col-md-6">
                                <input id="slack"
                                       type="text"
                                       class="form-control{{ $errors->has('slack') ? ' is-invalid' : '' }}"
                                       name="slack"
                                       value="{{ old('slack') }}">

                                @if ($errors->has('slack'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('slack') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Facebook -->
                        <div class="form-group row">
                            <label for="facebook" class="col-md-4 col-form-label text-md-right">
                                Facebook
                            </label>

                            <div class="col-md-6">
                                <input id="facebook"
                                       type="text"
                                       class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}"
                                       name="facebook"
                                       value="{{ old('facebook') }}">

                                @if ($errors->has('facebook'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('facebook') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Instagram -->
                        <div class="form-group row">
                            <label for="instagram" class="col-md-4 col-form-label text-md-right">
                                Instagram
                            </label>

                            <div class="col-md-6">
                                <input id="instagram"
                                       type="text"
                                       class="form-control{{ $errors->has('instagram') ? ' is-invalid' : '' }}"
                                       name="instagram"
                                       value="{{ old('instagram') }}">

                                @if ($errors->has('instagram'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('instagram') }}
                                    </div>
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
                                    <div class="invalid-feedback">
                                        {{ $errors->first('skype') }}
                                    </div>
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
                                    <div class="invalid-feedback">
                                        {{ $errors->first('github') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Bio -->
                        <div class="form-group row">
                            <label for="bio" class="col-md-4 col-form-label text-md-right">Bio</label>

                            <div class="col-md-6">
                                <textarea class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }}"
                                          rows="3"
                                          name="bio">{{ old('bio') }}</textarea>

                                @if ($errors->has('bio'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('bio') }}
                                    </div>
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
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
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
