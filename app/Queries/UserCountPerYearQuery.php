<?php

namespace App\Queries;

use App\User;

class UserCountPerYearQuery
{
    /**
     * Call an object as a function.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke()
    {
        return User::all()
            ->groupBy('year_of_created')
            ->map(function ($users, $year) {
                return User::whereYear('created_at', '<=', $year)->count();
            });
    }
}
