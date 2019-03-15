<?php

namespace App\Queries;

use Illuminate\Support\Facades\DB;

class OfficeUsersCountQuery
{
    /**
     * Call an object as a function.
     *
     * @return \Illuminate\Support\Collection
     */
    public function __invoke()
    {
        return DB::table('offices')
            ->select('offices.city', DB::raw('COUNT(*) as users_count'))
            ->join('users', 'offices.id', '=', 'users.office_id')
            ->groupBy('users.office_id')
            ->get();
    }
}
