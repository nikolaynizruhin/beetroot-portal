<?php

namespace App\Filters;

trait HasTag
{
    /**
     * Filter the query by a given tag name.
     *
     * @param  string  $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function tag($name)
    {
        return $this->builder->whereHas('tags', function ($query) use ($name) {
            $query->where('name', $name);
        });
    }
}
