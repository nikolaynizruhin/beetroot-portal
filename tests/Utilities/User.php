<?php

namespace Tests\Utilities;

class User
{
    /**
     * The list of attributes.
     *
     * @var array
     */
    protected static $attributes = [
        'name' => 'John Doe',
        'email' => 'johndoe@beetroot.se',
        'is_admin' => true,
        'position' => 'Python Developer',
        'birthday' => '1983-12-02 00:00:00',
        'slack' => 'johndoe',
        'client_id' => 1,
        'office_id' => 1,
        'github' => 'johndoe',
        'skype' => 'johndoe',
        'bio' => 'johndoe',
    ];

    /**
     * Get attributes.
     *
     * @return array
     */
    public static function getAttributes()
    {
        // $attributes = factory(\App\User::class)->make(['is_admin' => true])->toArray();

        // unset($attributes['password']);
        // unset($attributes['avatar']);
        // unset($attributes['birthday']);
        // unset($attributes['remember_token']);

        // return $attributes;
        return static::$attributes;
    }

    /**
     * Get input attributes.
     *
     * @param  array  $attributes
     * @param  object  $file
     * @return array
     */
    public static function getInputAttributes($attributes, $file)
    {
        $attributes['avatar'] = $file;

        return $attributes;
    }

    /**
     * Get result attributes.
     *
     * @param  array  $attributes
     * @param  object  $file
     * @return array
     */
    public static function getResultAttributes($attributes, $file)
    {
        $attributes['avatar'] = 'avatars/' . $file->hashName();

        return $attributes;
    }
}