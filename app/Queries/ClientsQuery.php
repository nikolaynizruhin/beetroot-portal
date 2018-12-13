<?php

namespace App\Queries;

use App\Client;
use App\Filters\ClientFilters;

class ClientsQuery
{
    /**
     * Call an object as a function.
     *
     * @param  ClientFilters  $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke(ClientFilters $filters)
    {
        return Client::with('tags')
            ->withCount(['users', 'tags'])
            ->filter($filters)
            ->paginate(15);
    }
}
