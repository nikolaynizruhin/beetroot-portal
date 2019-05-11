<?php

namespace App\Queries;

use App\User;
use App\Office;
use App\Activity;

class ActivityFeedQuery
{
    /**
     * Call an object as a function.
     *
     * @param  int  $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function __invoke($perPage = 15)
    {
        $activities = Activity::with('subject')->latest()->paginate($perPage);

        $activities->getCollection()->loadMorph('subject', [
            User::class => ['client', 'office'],
            Office::class => ['users'],
        ]);

        return $activities;
    }
}
