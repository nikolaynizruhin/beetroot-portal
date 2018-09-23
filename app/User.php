<?php

namespace App;

use App\Notifications\WelcomeNotification;
use App\Scopes\NameScope;
use App\Filters\Filterable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Filterable;

    /**
     * Constant representing a default user avatar.
     *
     * @var string
     */
    const DEFAULT_AVATAR = 'avatars/default.png';

    /**
     * Constant representing a male.
     *
     * @var string
     */
    const MALE = 'male';

    /**
     * Constant representing a female.
     *
     * @var string
     */
    const FEMALE = 'female';

    /**
     * The list of sorts.
     *
     * @var array
     */
    protected static $sorts = [
        'name' => 'Name',
        '-created_at' => 'Newcomers',
        'created_at' => 'Elders',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_admin' => 'boolean',
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
        'birthday',
    ];

    /**
     * Get the client for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the office for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    /**
     * Scope a query to only include users of a given position.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $position
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfPosition($query, $position)
    {
        return $query->where('position', $position);
    }

    /**
     * Get the month of the user birth.
     *
     * @return int
     */
    public function getMonthDayOfBirthAttribute()
    {
        return $this->birthday->format('md');
    }

    /**
     * Get the name of the month of the user birth.
     *
     * @return string
     */
    public function getNameOfMonthOfBirthAttribute()
    {
        return $this->birthday->format('F');
    }

    /**
     * Get the year of created at.
     *
     * @return string
     */
    public function getYearOfCreatedAttribute()
    {
        return $this->created_at->format('Y');
    }

    /**
     * Get list of sorts.
     *
     * @return array
     */
    public static function sorts()
    {
        return static::$sorts;
    }

    /**
     * Send the welcome notification.
     *
     * @param  string  $password
     * @return void
     */
    public function sendWelcomeNotification($password)
    {
        $this->notify(new WelcomeNotification($password));
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NameScope);

        static::deleting(function ($user) {
            if ($user->avatar !== self::DEFAULT_AVATAR) {
                Storage::delete($user->avatar);
            }
        });
    }
}
