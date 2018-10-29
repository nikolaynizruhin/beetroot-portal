<form method="GET" action="{{ route('clients.index') }}">
    <div class="row mb-3">
        <div class="col-md-4">

            <!-- Sorting -->
            <div class="form-group">
                <select class="form-control" name="sort">
                    @foreach ($sorts as $field => $name)
                        <option value="{{ $field }}"
                                @if (request('sort') == $field) selected @endif>
                            Sort By {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Name Filter -->
            <div class="form-group">
                <label for="name" class="sr-only">Name</label>
                <input type="text"
                       class="form-control"
                       id="name"
                       name="name"
                       value="{{ request('name') }}"
                       placeholder="Enter name">
            </div>

        </div>

        <div class="col-md-4">

            <!-- Country Filter -->
            <div class="form-group">
                <select class="form-control" name="country">
                    <option value="" selected>All Countries</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country }}"
                                @if (request('country') == $country) selected @endif>
                            {{ $country }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Technology Filter -->
            <div class="form-group">
                <select class="form-control" name="tag">
                    <option value="" selected>All Technologies</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->name }}"
                                @if (request('tag') == $tag->name) selected @endif>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="col-md-4">

            <!-- Clear Button -->
            <div class="form-group">
                <a class="btn btn-light btn-block" href="{{ route('clients.index') }}" role="button">
                    <i class="fas fa-times fa-fw"></i>
                    &nbsp;
                    Clear
                </a>
            </div>

            <!-- Filter Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-filter fa-fw"></i>
                    &nbsp;
                    Filter
                </button>
            </div>
        </div>
    </div>
</form>