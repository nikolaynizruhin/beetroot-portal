@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-tag fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Update Technology
                    </div>

                    <div class="card-body">

                        @include('layouts.partials.flash')

                        <form method="POST" action="{{ route('tags.update', $tag) }}">
                            @method('PUT')
                            @csrf

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
                                           value="{{ old('name', $tag->name) }}"
                                           required
                                           autofocus>

                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Update Button -->
                            <div class="form-group row mb-0">
                                <div class="col-md-3 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Delete Tag -->
                        <h4>Delete Tag</h4>
                        <hr>

                        <form id="delete-form"
                              method="POST"
                              action="{{ route('tags.destroy', $tag) }}">
                            @method('DELETE')
                            @csrf

                            <div class="form-group mb-0">
                                <!-- Delete Button -->
                                <div class="col-md-3 offset-md-4">
                                    <button type="submit"
                                            class="btn btn-light btn-block"
                                            onclick="event.preventDefault();
                                                if (confirm('Are you sure you want to delete a tag? This will remove a tag and all associated relations with Beetroots and Teams!'))
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
