@forelse ($months as $month => $users)
    <div class="row mb-3">
        <div class="col">
            <a class="text-reset" href="#{{ $month }}">
                <h3 id="{{ $month }}" class="text-right">
                    {{ $month }}
                    <i class="far fa-calendar-alt"></i>
                </h3>
            </a>

            <hr>

            @foreach ($users->chunk(3) as $chunk)
                <div class="row">
                    @each('birthdays.partials.birthday', $chunk, 'user')
                </div>
            @endforeach

        </div>
    </div>
@empty
    <p>No employees</p>
@endforelse
