<?php

namespace App\Filters;

use App\Office;

class BirthdayFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['office'];

    /**
     * Filter the query by a given office city.
     *
     * @param  string  $city
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function office($city)
    {
        $office = Office::where('city', $city)->firstOrFail();

        return $this->builder->where('office_id', $office->id);
    }
}
