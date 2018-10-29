<form method="GET" action="{{ route('users.index') }}">
    <div class="row mb-3">
        <div class="col-md-3">

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
                       name="name"
                       value="{{ request('name') }}"
                       id="name"
                       placeholder="Enter name">
            </div>

        </div>

        <div class="col-md-3">

            <!-- Office Filter -->
            <div class="form-group">
                <select class="form-control" name="office">
                    <option value="" selected>All Locations</option>
                    @foreach ($offices as $city)
                        <option value="{{ $city }}"
                                @if (request('office') == $city) selected @endif>
                            {{ $city }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Position Filter -->
            <div class="form-group">
                <select class="form-control" name="position">
                    <option value="" selected>All Positions</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position }}"
                                @if (request('position') == $position) selected @endif>
                            {{ $position }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">

            <!-- Client Filter -->
            <div class="form-group">
                <select class="form-control" name="client">
                    <option value="" selected>All Teams</option>
                    @foreach ($clients as $name)
                        <option value="{{ $name }}"
                                @if (request('client') == $name) selected @endif>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Skill Filter -->
            <div class="form-group">
                <select class="form-control" name="tag">
                    <option value="" selected>All Skills</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->name }}"
                                @if (request('tag') == $tag->name) selected @endif>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="col-md-3">

            <!-- Clear Button -->
            <div class="form-group">
                <a class="btn btn-light btn-block" href="{{ route('users.index') }}" role="button">
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