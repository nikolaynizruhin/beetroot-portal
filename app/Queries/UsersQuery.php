<?php

namespace App\Queries;

use App\User;
use App\Filters\UserFilters;

class UsersQuery
{
    /**
     * Call an object as a function.
     *
     * @param  UserFilters  $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke(UserFilters $filters)
    {
        return User::with(['client', 'office', 'tags'])
            ->withCount('tags')
            ->filter($filters)
            ->paginate(15);
    }
}
