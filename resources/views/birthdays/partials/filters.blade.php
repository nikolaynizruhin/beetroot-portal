<form method="GET" action="{{ route('birthdays.index') }}">
    <div class="row mb-3">
        <div class="col-md-4">

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

        </div>

        <div class="col-md-4">

            <!-- Clear Button -->
            <div class="form-group">
                <a class="btn btn-light btn-block" href="{{ route('birthdays.index') }}" role="button">
                    <i class="fas fa-times fa-fw"></i>
                    &nbsp;
                    Clear
                </a>
            </div>

        </div>

        <div class="col-md-4">

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