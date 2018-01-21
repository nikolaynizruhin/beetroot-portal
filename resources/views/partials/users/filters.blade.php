<form method="GET" action="{{ route('users.index') }}">
    <div class="row">
        <div class="col-sm-4">

            <!-- Office Filter -->
            <div class="form-group">
                <select class="form-control" name="office">
                    <option value="" selected>All Offices</option>
                    @foreach ($offices as $id => $city)
                        @if (request('office') == $city)
                            <option value="{{ $city }}" selected>
                                {{ $city }}
                            </option>
                        @else
                            <option value="{{ $city }}">
                                {{ $city }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Position Filter -->
            <div class="form-group">
                <select class="form-control" name="position">
                    <option value="" selected>All Positions</option>
                    @foreach ( $positions as $position )
                        @if (request('position') == $position)
                            <option value="{{ $position }}" selected>
                                {{ $position }}
                            </option>
                        @else
                            <option value="{{ $position }}">
                                {{ $position }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-4">

            <!-- Client Filter -->
            <div class="form-group">
                <select class="form-control" name="client">
                    <option value="" selected>All Clients</option>
                    @foreach ($clients as $id => $name)
                        @if (request('client') == $name)
                            <option value="{{ $name }}" selected>
                                {{ $name }}
                            </option>
                        @else
                            <option value="{{ $name }}">
                                {{ $name }}
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
                       name="name"
                       value="{{ request('name') }}" 
                       id="name"
                       placeholder="Name">
            </div>
        </div>

        <div class="col-sm-4">

            <!-- Clear Button -->
            <div class="form-group">
                <a class="btn btn-default btn-block" href="{{ route('users.index') }}" role="button">
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