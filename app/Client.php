<?php

namespace App;

use App\Filters\ClientFilters;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the users for the client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Apply all relevant client filters.
     *
     * @param  Builder  $query
     * @param  ClientFilters  $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, ClientFilters $filters)
    {
        return $filters->apply($query);
    }

    /**
     * Get countries.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function countries()
    {
        return static::pluck('country')->unique();
    }
}
