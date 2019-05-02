@csrf

<!-- Logo -->
<div class="form-group row">
    <label for="logo" class="col-md-4 col-form-label text-md-right">
        <span data-toggle="tooltip"
              data-placement="top"
              title="Square image (jpeg, png, bmp, gif, svg)">
            Logo
        </span>
    </label>

    <div class="col-md-6">
        <div class="custom-file">
            <input type="file" accept="image/*" class="custom-file-input" id="logo" name="logo">
            <label class="custom-file-label" for="logo">Choose file</label>
        </div>

        @error('logo')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

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
               value="{{ old('name', $client->name) }}"
               required
               @if ($errors->isEmpty()) autofocus @endif>

        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<!-- Site -->
<div class="form-group row">
    <label for="site" class="col-md-4 col-form-label text-md-right">
        <span data-toggle="tooltip"
              data-placement="top"
              title="Full url with schema (e.g., https://example.com)">
            Site
            <small>*</small>
        </span>
    </label>

    <div class="col-md-6">
        <input id="site"
               type="url"
               class="form-control @error('site') is-invalid @enderror"
               name="site"
               value="{{ old('site', $client->site) }}"
               required>

        @error('site')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<!-- Country -->
<div class="form-group row">
    <label for="country" class="col-md-4 col-form-label text-md-right">
        Country <small>*</small>
    </label>

    <div class="col-md-6">
        <select id="country" 
                class="form-control @error('country') is-invalid @enderror"
                name="country"
                required>
            @foreach ( $countries::all() as $country )
                <option value="{{ $country }}"
                        @if (old('country', $client->country) == $country) selected @endif>
                    {{ $country }}
                </option>
            @endforeach
        </select>

        @error('country')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<!-- Technologies -->
<div class="form-group row">
    <label for="tags" class="col-md-4 col-form-label text-md-right">
        Technologies
    </label>

    <div class="col-md-6">
        <select id="tags"
                class="form-control @error('tags') is-invalid @enderror"
                name="tags[]"
                multiple="multiple">
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}"
                        @if (collect(old('tags', $client->tags->pluck('id')))->contains($tag->id)) selected @endif>
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

<!-- Description -->
<div class="form-group row">
    <label for="description" class="col-md-4 col-form-label text-md-right">
        Description <small>*</small>
    </label>

    <div class="col-md-6">
        <textarea class="form-control @error('description') is-invalid @enderror"
                  rows="3"
                  name="description"
                  required>{{ old('description', $client->description) }}</textarea>

        @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
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
