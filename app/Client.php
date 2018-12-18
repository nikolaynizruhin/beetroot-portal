<?php

namespace App;

use App\Scopes\NameScope;
use App\Filters\Filterable;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Client extends Model
{
    use Filterable, Taggable;

    /**
     * Constant representing a default client logo.
     *
     * @var string
     */
    const DEFAULT_LOGO = 'logos/default.png';

    /**
     * Logo size in pixels.
     *
     * @var string
     */
    const LOGO_SIZE = 150;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The list of sorts.
     *
     * @var array
     */
    protected static $sorts = [
        'name' => 'Name',
        '-created_at' => 'Recent',
        'created_at' => 'Oldest',
    ];

    /**
     * Get the users for the client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
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
     * Get list of sorted client countries.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function countries()
    {
        return static::pluck('country')->unique()->sort();
    }

    /**
     * Check whatever clien has a default logo.
     *
     * @return bool
     */
    public function hasDefaultLogo()
    {
        return $this->logo === self::DEFAULT_LOGO;
    }

    /**
     * Get collection of logos in use.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function logosInUse()
    {
        return self::pluck('logo')
            ->merge(self::DEFAULT_LOGO)
            ->unique();
    }

    /**
     * Check whether need to optimize a logo.
     *
     * @return bool
     */
    public function needToOptimizeLogo()
    {
        return ! $this->hasDefaultLogo() && $this->isDirty('logo');
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

        static::saved(function ($client) {
            if ($client->needToOptimizeLogo()) {
                Image::make('storage/'.$client->logo)->fit(self::LOGO_SIZE)->save();
            }
        });

        static::deleting(function ($client) {
            if (! $client->hasDefaultLogo()) {
                Storage::delete($client->logo);
            }
        });
    }
}
