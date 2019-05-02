<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use RecordsActivity;

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
     * Get the list of sorted office cities.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function cities()
    {
        return self::pluck('city')->sort();
    }
}
