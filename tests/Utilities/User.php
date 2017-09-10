<?php

namespace Tests\Utilities;

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
        $attributes = factory(\App\User::class)->states('admin')->make()->toArray();

        unset($attributes['password']);
        unset($attributes['avatar']);
        unset($attributes['remember_token']);

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
     * @return array
     */
    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * Remove attribute.
     *
     * @param  string $key
     * @return array
     */
    public function removeAttribute($key)
    {
        unset($this->attributes[$key]);
    }
}