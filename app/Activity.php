<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * Constant representing an anniversary activity.
     *
     * @var string
     */
    const ANNIVERSARY = 'anniversary_user';

    /**
     * Constant representing a birthday activity.
     *
     * @var string
     */
    const BIRTHDAY = 'birthday_user';

    /**
     * Attributes to guard against mass assignment.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the subject of the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * Get user anniversary.
     *
     * @return int|null
     */
    public function anniversary()
    {
        return $this->isAnniversary()
            ? $this->subject->anniversary($this->created_at)
            : null;
    }

    /**
     * Check if activity is anniversary.
     *
     * @return bool
     */
    public function isAnniversary()
    {
        return $this->name === self::ANNIVERSARY;
    }

    /**
     * Scope a query to only include activities before given date.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Carbon\Carbon  $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBefore($query, $date)
    {
        return $query->where('created_at', '<', $date);
    }
}
