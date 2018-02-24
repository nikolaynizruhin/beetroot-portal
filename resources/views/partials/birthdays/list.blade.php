@forelse ($months as $month => $users)
    <div class="row mb-3">
        <div class="col">
            <h3 class="text-right">
                {{ $month }}
                <i class="far fa-calendar-alt"></i>
            </h3>

            <hr>

            @foreach ($users->chunk(3) as $chunk)
                <div class="row">
                    @each('partials.birthdays.birthday', $chunk, 'user')
                </div>
            @endforeach

        </div>
    </div>
@empty
    <p>No employees</p>
@endforelse
