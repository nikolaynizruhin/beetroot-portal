<?php

namespace App;

use App\Scopes\NameScope;
use App\Filters\Filterable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\WelcomeNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Filterable, Taggable, HasImage, RecordsActivity;

    /**
     * Constant representing a default user avatar.
     *
     * @var string
     */
    const DEFAULT_AVATAR = 'avatars/default.png';

    /**
     * Avatar size in pixels.
     *
     * @var string
     */
    const AVATAR_SIZE = 150;

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
     * Determine model image attribute.
     *
     * @var string
     */
    const IMAGE = 'avatar';

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
        'start_of_created_day',
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
    public function getMonthAndDayOfBirthAttribute()
    {
        return $this->birthday->format('md');
    }

    /**
     * Get the name of the month of the user birth.
     *
     * @return string
     */
    public function getMonthNameOfBirthAttribute()
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
     * Get the year of created at.
     *
     * @return \Carbon\Carbon
     */
    public function getStartOfCreatedDayAttribute()
    {
        return $this->created_at->startOfDay();
    }

    /**
     * Get user anniversary for a given date.
     *
     * @param  \Carbon\Carbon|null  $date
     * @return int|null
     */
    public function anniversary($date = null)
    {
        return $this->hasAnniversary($date = $date ?: now())
            ? $this->start_of_created_day->diffInYears($date)
            : null;
    }

    /**
     * Get list of sorts.
     *
     * @return array
     */
    public static function sorts()
    {
        return [
            'name' => 'Name',
            '-created_at' => 'Newcomers',
            'created_at' => 'Elders',
        ];
    }

    /**
     * Get list of genders.
     *
     * @return array
     */
    public static function genders()
    {
        return [self::MALE, self::FEMALE];
    }

    /**
     * Get list of unique sorted user positions.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function positions()
    {
        return static::pluck('position')->unique()->sort();
    }

    /**
     * Get collection of avatars in use.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function usedAvatars()
    {
        return self::pluck('avatar')
            ->merge(self::DEFAULT_AVATAR)
            ->unique();
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
     * Accept privacy.
     *
     * @return void
     */
    public function accept()
    {
        $this->update(['accepted_at' => now()]);
    }

    /**
     * Check if user was created before given year.
     *
     * @param  string  $year
     * @return bool
     */
    public function isBefore($year)
    {
        return $this->year_of_created <= $year;
    }

    /**
     * Check if user has birthday.
     *
     * @return bool
     */
    public function hasBirthday()
    {
        return $this->birthday->isBirthday();
    }

    /**
     * Check if user has anniversary.
     *
     * @param  \Carbon\Carbon|null  $date
     * @return bool
     */
    public function hasAnniversary($date = null)
    {
        return $this->created_at->isBirthday($date = $date ?: now())
            && $this->start_of_created_day->diffInYears($date) >= 1;
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
    }
}
