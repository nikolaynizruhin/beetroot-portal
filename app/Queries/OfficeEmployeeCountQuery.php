<?php

namespace App\Queries;

use Illuminate\Support\Facades\DB;

class OfficeEmployeeCountQuery
{
    /**
     * Call an object as a function.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke()
    {
        return DB::table('offices')
            ->select('offices.city', DB::raw('COUNT(*) as employee_count'))
            ->join('users', 'offices.id', '=', 'users.office_id')
            ->groupBy('users.office_id')
            ->get();
    }
}
