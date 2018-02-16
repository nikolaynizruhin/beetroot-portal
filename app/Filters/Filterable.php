<?php

namespace App\Filters;

use App\Filters\Filters as QueryFilters;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Apply filters.
     *
     * @param  Builder  $query
     * @param  QueryFilters  $filters
     * @return Builder
     */
    public function scopeFilter($query, QueryFilters $filters)
    {
        return $filters->apply($query);
    }
}
