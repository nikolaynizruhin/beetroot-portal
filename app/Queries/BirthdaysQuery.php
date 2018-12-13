<?php

namespace App\Queries;

use App\User;
use App\Filters\BirthdayFilters;

class BirthdaysQuery
{
    /**
     * Call an object as a function.
     *
     * @param  BirthdayFilters  $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke(BirthdayFilters $filters)
    {
        return User::with(['client', 'office'])
            ->filter($filters)
            ->get()
            ->sortBy('month_and_day_of_birth')
            ->groupBy('month_name_of_birth');
    }
}
