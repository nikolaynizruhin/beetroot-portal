<?php

namespace App\Queries;

use Illuminate\Support\Facades\DB;

class GenderCountQuery
{
    /**
     * Call an object as a function.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke()
    {
        return DB::table('users')
            ->select('gender', DB::raw('COUNT(*) as count'))
            ->groupBy('gender')
            ->orderBy('count', 'desc')
            ->get();
    }
}
