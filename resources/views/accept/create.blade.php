@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-clipboard-check fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Accept Privacy Policy
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('accept.store') }}">
                            @csrf

                            <!-- Accept -->
                            <div class="form-group row">
                                <div class="col-md-10 offset-md-1">
                                    <div class="form-check">
                                        <input class="form-check-input{{ $errors->has('privacy') ? ' is-invalid' : '' }}"
                                               type="checkbox"
                                               id="privacy"
                                               name="privacy"
                                               {{ old('privacy') ? 'checked' : '' }}
                                               required>
                                        <label class="form-check-label" for="privacy">
                                            I agree that Beetroot saves my information according to their <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a>, and it is gathered for internal use only.
                                        </label>

                                        @if ($errors->has('privacy'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('privacy') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-check fa-fw"></i>
                                        Accept
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
