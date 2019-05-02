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
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke()
    {
        $activities = Activity::with('subject')->latest()->paginate(15);

        $activities->getCollection()->loadMorph('subject', [
            User::class => ['client', 'office'],
            Office::class => ['users'],
        ]);

        return $activities;
    }
}