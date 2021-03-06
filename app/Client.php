<?php

namespace App;

use App\Scopes\NameScope;
use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use Filterable, Taggable, HasImage, RecordsActivity;

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
     * Determine model image attribute.
     *
     * @var string
     */
    const IMAGE = 'logo';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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
        return [
            'name' => 'Name',
            '-created_at' => 'Recent',
            'created_at' => 'Oldest',
        ];
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
     * Get collection of logos in use.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function usedLogos()
    {
        return self::pluck('logo')
            ->merge(self::DEFAULT_LOGO)
            ->unique();
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
