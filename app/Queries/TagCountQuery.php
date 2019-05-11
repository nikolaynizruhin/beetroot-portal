<?php

namespace App\Queries;

use App\Tag;

class TagCountQuery
{
    /**
     * Call an object as a function.
     *
     * @param  int  $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke($limit = 7)
    {
        return Tag::withCount(['users', 'clients'])
            ->get()
            ->sortByDesc('users_and_clients_count')
            ->take($limit)
            ->values();
    }
}
