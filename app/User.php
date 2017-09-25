<?php

namespace App;

use App\Client;
use App\Office;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use Laravel\Passport\HasApiTokens;
use Intervention\Image\Facades\Image;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
            'is_admin' => 'boolean'
        ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'birthday'
    ];

    /**
     * Get the client for the user.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the office for the user.
     */
    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    /**
     * Create a user from request.
     *
     * @param  \App\Http\Requests\StoreUser  $request
     * @return \App\User
     */
    public static function createFromRequest(StoreUser $request)
    {
        $attributes = request(['name', 'email', 'position', 'birthday', 'bio', 'slack', 'skype', 'github', 'client_id', 'office_id']);

        $path = $request->file('avatar')->store('avatars');
        $attributes['avatar'] = $path;
        Image::make('storage/' . $path)->fit(150)->save();
        $attributes['remember_token'] = str_random(10);
        $attributes['is_admin'] = (bool) $request->is_admin;
        $attributes['password'] = bcrypt($request->password);

        return static::create($attributes);
    }

    /**
     * Update a user from request.
     *
     * @param  \App\Http\Requests\UpdateUser  $request
     * @return bool
     */
    public function updateFromRequest(UpdateUser $request)
    {
        $attributes = request(['name', 'position', 'birthday', 'bio', 'slack', 'skype', 'github', 'client_id', 'office_id']);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars');
            $attributes['avatar'] = $path;
            Image::make('storage/' . $path)->fit(150)->save();
        }

        if (auth()->user()->is_admin) {
            $attributes['is_admin'] = (bool) $request->is_admin;
            $attributes['email'] = $request->email;
        }

        return $this->update($attributes);
    }
}
