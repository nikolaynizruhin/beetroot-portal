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
}
