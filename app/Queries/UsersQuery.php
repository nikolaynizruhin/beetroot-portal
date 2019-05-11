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
     * @param  int  $perPage
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke(UserFilters $filters, $perPage = 15)
    {
        return User::with(['client', 'office', 'tags'])
            ->withCount('tags')
            ->filter($filters)
            ->paginate($perPage);
    }
}
