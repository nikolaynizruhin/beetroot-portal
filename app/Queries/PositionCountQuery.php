<?php

namespace App\Queries;

use Illuminate\Support\Facades\DB;

class PositionCountQuery
{
    /**
     * Call an object as a function.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke()
    {
        return DB::table('users')
            ->select('position as title', DB::raw('COUNT(*) as count'))
            ->groupBy('position')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();
    }
}