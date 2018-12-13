<?php

namespace App\Queries;

use App\Office;

class OfficesQuery
{
    /**
     * Call an object as a function.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke()
    {
        return Office::with('users')
            ->withCount('users')
            ->orderBy('users_count', 'desc')
            ->paginate(10);
    }
}
