<form method="GET" action="{{ route('clients.index') }}">
    <div class="row mb-3">
        <div class="col-md-4">

            <!-- Sorting -->
            <div class="form-group">
                <select class="form-control" name="sort">
                    @foreach ($sorts as $field => $name)
                        @if (request('sort') == $field)
                            <option value="{{ $field }}" selected>
                                Sort By {{ $name }}
                            </option>
                        @else
                            <option value="{{ $field }}">
                                Sort By {{ $name }}
                            </option>
                        @endif
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
                        @if (request('country') == $country)
                            <option value="{{ $country }}" selected>
                                {{ $country }}
                            </option>
                        @else
                            <option value="{{ $country }}">
                                {{ $country }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Technology Filter -->
            <div class="form-group">
                <select class="form-control" name="tag">
                    <option value="" selected>All Technologies</option>
                    @foreach ($tags as $tag)
                        @if (request('tag') == $tag->name)
                            <option value="{{ $tag->name }}" selected>
                                {{ $tag->name }}
                            </option>
                        @else
                            <option value="{{ $tag->name }}">
                                {{ $tag->name }}
                            </option>
                        @endif
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