@csrf

<!-- Country -->
<div class="form-group row">
    <label for="country" class="col-md-4 col-form-label text-md-right">
        Country <small>*</small>
    </label>

    <div class="col-md-6">
        <select id="country"
                class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}"
                name="country"
                required>
            @foreach ($countries::all() as $country)
                <option value="{{ $country }}"
                        @if (old('country', $office->country) == $country) selected @endif>
                    {{ $country }}
                </option>
            @endforeach
        </select>

        @if ($errors->has('country'))
            <div class="invalid-feedback">
                {{ $errors->first('country') }}
            </div>
        @endif
    </div>
</div>

<!-- City -->
<div class="form-group row">
    <label for="city" class="col-md-4 col-form-label text-md-right">
        City <small>*</small>
    </label>

    <div class="col-md-6">
        <input id="city"
               type="text"
               class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
               name="city"
               value="{{ old('city', $office->city) }}"
               required
               autofocus>

        @if ($errors->has('city'))
            <div class="invalid-feedback">
                {{ $errors->first('city') }}
            </div>
        @endif
    </div>
</div>

<!-- Address -->
<div class="form-group row">
    <label for="address" class="col-md-4 col-form-label text-md-right">
        Address <small>*</small>
    </label>

    <div class="col-md-6">
        <input id="address"
               type="text"
               class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
               name="address"
               value="{{ old('address', $office->address) }}"
               required
               autofocus>

        @if ($errors->has('address'))
            <div class="invalid-feedback">
                {{ $errors->first('address') }}
            </div>
        @endif
    </div>
</div>

<!-- Link -->
<div class="form-group row">
    <label for="link" class="col-md-4 col-form-label text-md-right">
        <span data-toggle="tooltip"
              data-placement="top"
              title="Google maps query (e.g., Beetroot+Academy,Kiev)">
            Link
            <small>*</small>
        </span>
    </label>

    <div class="col-md-6">
        <input id="link"
               type="text"
               class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}"
               name="link"
               value="{{ old('link', $office->link) }}"
               required>

        @if ($errors->has('link'))
            <div class="invalid-feedback">
                {{ $errors->first('link') }}
            </div>
        @endif
    </div>
</div>

<!-- Button -->
<div class="form-group row">
    <div class="col-md-3 offset-md-4">
        <button type="submit" class="btn btn-primary btn-block">
            {{ $button ?? 'Create' }}
        </button>
    </div>
</div>