<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'site',
        'location',
        'description',
        'logo'
    ];

    /**
     * Get the users for the client.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
