<?php

namespace App;

use App\User;
use App\Http\Requests\StoreClient;
use App\Http\Requests\UpdateClient;
use Intervention\Image\Facades\Image;
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
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Create a client from request.
     *
     * @param  \App\Http\Requests\StoreClient  $request
     * @return \App\Client
     */
    public static function createFromRequest(StoreClient $request)
    {
        $attributes = request(['name', 'country', 'description', 'site']);

        $path = $request->file('logo')->store('logos');
        $attributes['logo'] = $path;
        Image::make('storage/' . $path)->fit(150)->save();

        return static::create($attributes);
    }

    /**
     * Update a client from request.
     *
     * @param  \App\Http\Requests\UpdateClient  $request
     * @return bool
     */
    public function updateFromRequest(UpdateClient $request)
    {
        $attributes = request(['name', 'country', 'description', 'site']);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos');
            $attributes['logo'] = $path;
            Image::make('storage/' . $path)->fit(150)->save();
        }

        return $this->update($attributes);
    }
}
