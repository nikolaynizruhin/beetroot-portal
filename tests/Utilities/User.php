<?php

namespace Tests\Utilities;

use App\User as UserModel;

class User
{
    /**
     * The list of attributes.
     *
     * @var array
     */
    private $attributes = [];

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        $attributes = factory(UserModel::class)
            ->states('admin')
            ->make()->toArray();

        unset(
            $attributes['avatar'], 
            $attributes['password'], 
            $attributes['remember_token']
        );

        $this->attributes = $attributes;
    }

    /**
     * Get attributes.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Set attribute.
     *
     * @param  string  $key
     * @param  string|object  $value
     * @return void
     */
    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * Remove attribute.
     *
     * @param  string $key
     * @return void
     */
    public function removeAttribute($key)
    {
        unset($this->attributes[$key]);
    }

    /**
     * Remove attributes.
     *
     * @param  array $keys
     * @return void
     */
    public function removeAttributes($keys)
    {
        foreach ($keys as $key) {
            unset($this->attributes[$key]);
        }
    }
}
