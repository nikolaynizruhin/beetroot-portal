<?php

namespace App;

use App\Client;
use App\Office;
use App\Utilities\Image;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use Laravel\Passport\HasApiTokens;
use App\Http\Requests\UpdateProfile;
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
        $attributes = request(static::getStoreAttributes());

        $attributes['avatar'] = Image::fit($request->file('avatar')->store('avatars'));
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
        $attributes = request(static::getStoreAttributes());

        if ($request->hasFile('avatar')) {
            $attributes['avatar'] = Image::fit($request->file('avatar')->store('avatars'));
        }

        $attributes['is_admin'] = (bool) $request->is_admin;

        return $this->update($attributes);
    }

    /**
     * Get attributes
     *
     * @return array
     */
    public static function getStoreAttributes()
    {
        return [
            'name',
            'email',
            'position',
            'birthday',
            'phone',
            'bio',
            'slack',
            'skype',
            'github',
            'client_id',
            'office_id'
        ];
    }
}
