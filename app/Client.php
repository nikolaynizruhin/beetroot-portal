<?php

namespace App;

use App\User;
use App\Http\Requests\StoreClient;
use App\Http\Requests\UpdateClient;
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
        'country',
        'description',
        'logo'
    ];

    /**
     * Get the users for the client.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Create a client from request.
     *
     * @param  \App\Http\Requests\StoreClient  $request
     * @return \App\User
     */
    public static function createFromRequest(StoreClient $request)
    {
        $attributes = $request->only(['name', 'country', 'description', 'site']);

        $path = $request->file('logo')->store('logos');

        $attributes['logo'] = $path;

        return static::create($attributes);
    }

    /**
     * Update a client from request.
     *
     * @param  \App\Http\Requests\UpdateClient  $request
     * @return \App\User
     */
    public function updateFromRequest(UpdateClient $request)
    {
        $attributes = $request->only(['name', 'country', 'description', 'site']);

        if ($request->hasFile('logo')) {

            $path = $request->file('logo')->store('logos');

            $attributes['logo'] = $path;

        }

        return $this->update($attributes);
    }
}
