@csrf

<!-- Name -->
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">
        Name <small>*</small>
    </label>

    <div class="col-md-6">
        <input id="name"
               type="text"
               class="form-control @error('name') is-invalid @enderror"
               name="name"
               value="{{ old('name', $tag->name) }}"
               required
               autofocus>

        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<!-- Button -->
<div class="form-group row mb-0">
    <div class="col-md-3 offset-md-4">
        <button type="submit" class="btn btn-primary btn-block">
            {{ $button ?? 'Create' }}
        </button>
    </div>
</div>