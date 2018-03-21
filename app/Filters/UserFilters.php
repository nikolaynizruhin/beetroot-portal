<?php

namespace App\Filters;

use App\Client;
use App\Office;

class UserFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['name', 'position', 'office', 'client', 'sort'];

    /**
     * Filter the query by a given name.
     *
     * @param  string  $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function name($name)
    {
        return $this->builder->where('name', 'like', '%'.$name.'%');
    }

    /**
     * Filter the query by a given position.
     *
     * @param  string  $position
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function position($position)
    {
        return $this->builder->where('position', $position);
    }

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

    /**
     * Filter the query by a given client name.
     *
     * @param  string  $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function client($name)
    {
        $client = Client::where('name', $name)->firstOrFail();

        return $this->builder->where('client_id', $client->id);
    }

    /**
     * Sort the query by a given user attribute.
     *
     * @param  string  $attribute
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function sort($attribute)
    {
        [$attribute, $order] = explode(',', $attribute);

        return $this->builder->orderBy($attribute, $order);
    }
}
