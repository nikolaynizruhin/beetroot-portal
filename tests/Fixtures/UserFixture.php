<?php

namespace Tests\Fixtures;

use App\User;

class UserFixture
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
        $attributes = factory(User::class)
            ->states('admin')
            ->make()
            ->toArray();

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
    public function attributes()
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
    public function set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * Remove attributes.
     *
     * @param  array|string $keys
     * @return void
     */
    public function remove($keys)
    {
        foreach ($keys as $key) {
            unset($this->attributes[$key]);
        }
    }
}
