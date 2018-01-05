<?php

namespace App;

use App\User;
use App\Utilities\Image;
use App\Http\Requests\StoreClient;
use App\Http\Requests\UpdateClient;
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
}
