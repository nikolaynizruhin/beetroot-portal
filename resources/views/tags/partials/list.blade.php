@if (count($tags))
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Beetroots</th>
                <th scope="col">Teams</th>
                @admin
                    <th scope="col">Actions</th>
                @endadmin
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $index => $tag)
                <tr>
                    <th scope="row">{{ $index + $tags->firstItem() }}</th>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->users->count() }}</td>
                    <td>{{ $tag->clients->count() }}</td>
                    @admin
                        <td>
                            <a href="{{ route('tags.edit', $tag->id) }}">
                                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                            </a>
                        </td>
                    @endadmin
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No Technologies</p>
@endif
