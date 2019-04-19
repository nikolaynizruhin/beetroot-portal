@csrf

<!-- Accept -->
<div class="form-group row">
    <div class="col-md-10 offset-md-1">
        <div class="form-check">
            <input class="form-check-input @error('privacy') is-invalid @enderror"
                   type="checkbox"
                   id="privacy"
                   name="privacy"
                   {{ old('privacy') ? 'checked' : '' }}
                   required>
            <label class="form-check-label" for="privacy">
                I agree that Beetroot saves my information according to their <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a>, and it is gathered for internal use only.
            </label>

            @error('privacy')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
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