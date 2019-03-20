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
            ->withCount([
                'users',
                'users as local_managers_count' => function ($query) {
                    $query->ofPosition('Local Management');
                },
                'users as office_managers_count' => function ($query) {
                    $query->ofPosition('Office Manager');
                },
            ])->orderBy('users_count', 'desc')
            ->paginate(10);
    }
}
