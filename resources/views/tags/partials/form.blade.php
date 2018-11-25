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

<!-- Button -->
<div class="form-group row mb-0">
    <div class="col-md-3 offset-md-4">
        <button type="submit" class="btn btn-primary btn-block">
            {{ $button ?? 'Create' }}
        </button>
    </div>
</div>