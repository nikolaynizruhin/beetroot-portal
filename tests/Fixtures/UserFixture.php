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
        $this->attributes = factory(User::class)
            ->states('admin')
            ->make()
            ->makeHidden(['avatar'])
            ->toArray();
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
