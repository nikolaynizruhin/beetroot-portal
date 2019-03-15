<?php

namespace App\Queries;

use Illuminate\Support\Facades\DB;

class ClientCountQuery
{
    /**
     * Call an object as a function.
     *
     * @return \Illuminate\Support\Collection
     */
    public function __invoke()
    {
        return DB::table('clients')
            ->select('country', DB::raw('COUNT(*) as count'))
            ->groupBy('country')
            ->orderBy('count', 'desc')
            ->get();
    }
}
