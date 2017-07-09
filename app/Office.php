<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city', 'country', 'address'
    ];

    /**
     * Get the users for the office.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
