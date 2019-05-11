<?php

namespace App\Queries;

use App\Tag;

class TagCountQuery
{
    /**
     * Call an object as a function.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke()
    {
        return Tag::withCount(['users', 'clients'])
            ->get()
            ->sortByDesc('users_and_clients_count')
            ->take(7)
            ->values();
    }
}
