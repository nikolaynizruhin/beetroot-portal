<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
        'avatar',
        'birthday',
        'office_id',
        'client_id',
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
        return $this->belongsTo('App\Client');
    }

    /**
     * Get the office for the user.
     */
    public function office()
    {
        return $this->belongsTo('App\Office');
    }

    /**
     * Create a user from request.
     *
     * @param  \App\Http\Requests\StoreUser  $request
     * @return \App\User
     */
    public static function createFromRequest(StoreUser $request)
    {
        $attributes = $request->only(['name', 'email', 'position', 'birthday', 'client_id', 'office_id', 'password']);

        $path = $request->file('avatar')->store('avatars');

        $attributes['avatar'] = $path;

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
        $attributes = $request->only(['name', 'email', 'position', 'birthday', 'client_id', 'office_id']);

        if ($request->hasFile('avatar')) {

            $path = $request->file('avatar')->store('avatars');

            $attributes['avatar'] = $path;

        }

        return $this->update($attributes);
    }
}
