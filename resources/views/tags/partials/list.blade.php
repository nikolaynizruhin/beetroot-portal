@if (count($tags))
    <div class="table-responsive">
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
                        <td>
                            <a href="{{ route('users.index', ['tag' => $tag->name]) }}">
                                {{ $tag->users->count() }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('clients.index', ['tag' => $tag->name]) }}">
                                {{ $tag->clients->count() }}
                            </a>
                        </td>
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
    </div>
@else
    <p>No Technologies</p>
@endif
