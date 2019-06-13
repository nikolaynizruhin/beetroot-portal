<?php

namespace App\Queries;

use App\User;
use App\Office;
use App\Activity;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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
        return Activity::with([
            'subject' => function (MorphTo $morphTo) {
                $morphTo->morphWith([
                    User::class => ['client', 'office'],
                    Office::class => ['users'],
                ]);
            }])->latest()
            ->paginate($perPage);
    }
}
