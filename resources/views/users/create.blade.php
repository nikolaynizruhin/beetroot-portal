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
                                    <input class="form-check-input @error('is_admin') is-invalid @enderror"
                                           type="checkbox"
                                           id="checkbox-admin"
                                           name="is_admin"
                                           value="1"
                                           {{ old('is_admin') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="checkbox-admin">
                                        Admin
                                    </label>

                                    @error('is_admin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
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
                                        <input class="form-check-input @error('gender') is-invalid @enderror"
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
                                        <input class="form-check-input @error('gender') is-invalid @enderror"
                                               type="radio"
                                               name="gender"
                                               id="gender-female"
                                               value="female"
                                               required>
                                        <label class="form-check-label" for="gender-female">
                                            Female
                                        </label>

                                        @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </fieldset>

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
                                <div class="custom-file">
                                    <input type="file" accept="image/*" class="custom-file-input" id="avatar" name="avatar">
                                    <label class="custom-file-label" for="avatar">Choose file</label>
                                </div>

                                @error('avatar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       value="{{ old('name') }}"
                                       required
                                       @if ($errors->isEmpty()) autofocus @endif>

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required>

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Position -->
                        <div class="form-group row">
                            <label for="position" class="col-md-4 col-form-label text-md-right">
                                Position <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <select id="position" 
                                        class="form-control @error('position') is-invalid @enderror"
                                        name="position"
                                        required>
                                    <option value="">Select a position...</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position }}" @if (old('position') == $position) selected @endif>
                                            {{ $position }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Client -->
                        <div class="form-group row">
                            <label for="client-id" class="col-md-4 col-form-label text-md-right">
                                Team <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <select id="client-id"
                                        class="form-control @error('client_id') is-invalid @enderror"
                                        name="client_id"
                                        required>
                                    <option value="">Select a team...</option>
                                    @foreach ($clients as $id => $name)
                                        <option value="{{ $id }}" @if (old('client_id') == $id) selected @endif>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('client_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Office -->
                        <div class="form-group row">
                            <label for="office-id" class="col-md-4 col-form-label text-md-right">
                                Location <small>*</small>
                            </label>

                            <div class="col-md-6">
                                <select id="office-id"
                                        class="form-control @error('office_id') is-invalid @enderror"
                                        name="office_id"
                                        required>
                                    <option value="">Select a location...</option>
                                    @foreach ($offices as $id => $city)
                                        <option value="{{ $id }}" @if (old('office_id') == $id) selected @endif>
                                            {{ $city }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('office_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                       class="form-control @error('birthday') is-invalid @enderror"
                                       name="birthday"
                                       value="{{ old('birthday') }}"
                                       required>

                                @error('birthday')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                       class="form-control @error('created_at') is-invalid @enderror"
                                       name="created_at"
                                       value="{{ old('created_at', now()->toDateString()) }}"
                                       required>

                                @error('created_at')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Skills -->
                        <div class="form-group row">
                            <label for="tags" class="col-md-4 col-form-label text-md-right">
                                Skills
                            </label>

                            <div class="col-md-6">
                                <select id="tags"
                                        class="form-control @error('tags') is-invalid @enderror"
                                        name="tags[]"
                                        multiple="multiple">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" @if (collect(old('tags'))->contains($tag->id)) selected @endif>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('tags')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">
                                <span data-toggle="tooltip"
                                      data-placement="top"
                                      title="+38(063)1234567">
                                    Phone
                                </span>
                            </label>

                            <div class="col-md-6">
                                <input id="phone"
                                       type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       name="phone"
                                       value="{{ old('phone') }}">

                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Slack -->
                        <div class="form-group row">
                            <label for="slack" class="col-md-4 col-form-label text-md-right">
                                <span data-toggle="tooltip"
                                      data-placement="top"
                                      title="Slack username">
                                    Slack
                                </span>
                            </label>

                            <div class="col-md-6">
                                <input id="slack"
                                       type="text"
                                       class="form-control @error('slack') is-invalid @enderror"
                                       name="slack"
                                       value="{{ old('slack') }}">

                                @error('slack')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Facebook -->
                        <div class="form-group row">
                            <label for="facebook" class="col-md-4 col-form-label text-md-right">
                                <span data-toggle="tooltip"
                                      data-placement="top"
                                      title="Facebook username">
                                    Facebook
                                </span>
                            </label>

                            <div class="col-md-6">
                                <input id="facebook"
                                       type="text"
                                       class="form-control @error('facebook') is-invalid @enderror"
                                       name="facebook"
                                       value="{{ old('facebook') }}">

                                @error('facebook')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Instagram -->
                        <div class="form-group row">
                            <label for="instagram" class="col-md-4 col-form-label text-md-right">
                                <span data-toggle="tooltip"
                                      data-placement="top"
                                      title="Instagram username">
                                    Instagram
                                </span>
                            </label>

                            <div class="col-md-6">
                                <input id="instagram"
                                       type="text"
                                       class="form-control @error('instagram') is-invalid @enderror"
                                       name="instagram"
                                       value="{{ old('instagram') }}">

                                @error('instagram')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Skype -->
                        <div class="form-group row">
                            <label for="skype" class="col-md-4 col-form-label text-md-right">
                                <span data-toggle="tooltip"
                                      data-placement="top"
                                      title="Skype username">
                                    Skype
                                </span>
                            </label>

                            <div class="col-md-6">
                                <input id="skype"
                                       type="text"
                                       class="form-control @error('skype') is-invalid @enderror"
                                       name="skype"
                                       value="{{ old('skype') }}">

                                @error('skype')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                       class="form-control @error('github') is-invalid @enderror"
                                       name="github"
                                       value="{{ old('github') }}">

                                @error('github')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Bio -->
                        <div class="form-group row">
                            <label for="bio" class="col-md-4 col-form-label text-md-right">Bio</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('bio') is-invalid @enderror"
                                          rows="3"
                                          name="bio">{{ old('bio') }}</textarea>

                                @error('bio')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password"
                                       minlength="8"
                                       required>

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                       minlength="8"
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
