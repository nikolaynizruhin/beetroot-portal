<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the users for the office.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the count of users by position for the office.
     *
     * @return int
     */
    public function countOf($position)
    {
        return $this->users()->ofPosition($position)->count();
    }

    /**
     * Get the list of sorted office cities.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function cities()
    {
        return self::pluck('city')->sort();
    }
}
