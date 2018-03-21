<?php

namespace App\Http\Utilities;

class UserSortableAttribute
{
    /**
     * The list of sortable attributes.
     *
     * @var array
     */
    protected static $attributes = [
        'name,asc' => 'Name',
        'created_at,desc' => 'Newcomers',
        'created_at,asc' => 'Elders',
    ];

    /**
     * Get all sortable attributes.
     *
     * @return array
     */
    public static function all()
    {
        return static::$attributes;
    }
}
