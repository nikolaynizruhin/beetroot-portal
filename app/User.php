<?php

namespace App;

use App\Client;
use App\Office;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use Laravel\Passport\HasApiTokens;
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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'is_admin',
        'password',
        'position',
        'avatar',
        'birthday',
        'bio',
        'slack',
        'skype',
        'github',
        'office_id',
        'client_id',
        'remember_token'
    ];

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
     * Set the user password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

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
        $attributes = $request->only(['name', 'email', 'position', 'birthday', 'bio', 'slack', 'skype', 'github', 'client_id', 'office_id', 'password']);

        $path = $request->file('avatar')->store('avatars');

        $attributes['avatar'] = $path;

        $attributes['remember_token'] = str_random(10);

        $request->is_admin ? $attributes['is_admin'] = 1 : $attributes['is_admin'] = 0;

        return static::create($attributes);
    }

    /**
     * Update a user from request.
     *
     * @param  \App\Http\Requests\UpdateUser  $request
     * @return \App\User
     */
    public function updateFromRequest(UpdateUser $request)
    {
        $attributes = $request->only(['name', 'email', 'position', 'birthday', 'bio', 'slack', 'skype', 'github', 'client_id', 'office_id']);

        if ($request->hasFile('avatar')) {

            $path = $request->file('avatar')->store('avatars');

            $attributes['avatar'] = $path;

        }

        if (auth()->user()->is_admin) {
            $request->is_admin ? $attributes['is_admin'] = 1 : $attributes['is_admin'] = 0;
        }

        return $this->update($attributes);
    }
}
