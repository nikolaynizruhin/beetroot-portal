<?php

namespace App\Http\Utilities;

class Position
{
    /**
     * The list of positions.
     *
     * @var array
     */
    protected static $positions = [
        'Ruby/Rails Developer',
        'Swift Developer',
        'Python Developer',
        'PHP Developer',
        'JavaScript Developer',
        'Java Developer',
        'Golang Developer',
        'C++ Developer',
        'C#/.NET Developer',
        'Project Manager',
        'Office Manager',
        'Account Manager',
        'Sales Manager',
        'Marketing',
        'HR',
        'DevOps',
        'Designer',
        'QA Engineer',
        'CEO',
        'CFO',
        'CMO'
    ];

    /**
     * Get all positions.
     *
     * @return array
     */
    public static function all()
    {
        return static::$positions;
    }
}