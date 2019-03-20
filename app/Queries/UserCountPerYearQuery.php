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
        return ($users = User::all())
            ->groupBy('year_of_created')
            ->map(function ($usersByYear, $year) use ($users) {
                return $users->filter(function ($user) use ($year) {
                    return $user->year_of_created <= $year;
                })->count();
            });
    }
}
