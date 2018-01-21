<form method="GET" action="{{ route('clients.index') }}">
    <div class="row">
        <div class="col-sm-3">

            <!-- Country Filter -->
            <div class="form-group">
                <select class="form-control" name="country">
                    <option value="" selected>All Countries</option>
                    @foreach ( $countries::all() as $country )
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
        </div>

        <div class="col-sm-3">

            <!-- Name Filter -->
            <div class="form-group">
                <label for="name" class="sr-only">Name</label>
                <input type="text"
                       class="form-control"
                       id="name"
                       name="name" 
                       value="{{ request('name') }}" 
                       placeholder="Name">
            </div>
        </div>

        <div class="col-sm-3">

            <!-- Clear Button -->
            <div class="form-group">
                <a class="btn btn-default btn-block" href="{{ route('clients.index') }}" role="button">
                    <i class="fas fa-times fa-fw"></i>
                    &nbsp;
                    Clear
                </a>
            </div>
        </div>

        <div class="col-sm-3">

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