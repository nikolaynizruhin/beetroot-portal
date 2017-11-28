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
        'Python Developer',
        'JavaScript Developer',
        'Node.js Developer',
        'Ruby/Rails Developer',
        'PHP Developer',
        'Swift Developer',
        'Objective-C Developer',
        'Java Developer',
        'Scala Developer',
        'Kotlin Developer',
        'Golang Developer',
        'C++ Developer',
        'C#/.NET Developer',
        'C Developer',
        'Business analyst',
        'Data Scientist / Data Analyst',
        'Project Manager',
        'Office Manager',
        'Account Manager',
        'Financial manager',
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

    /**
     * Get random position.
     *
     * @return string
     */
    public static function rand()
    {
        $key = array_rand(static::$positions);

        return static::$positions[$key];
    }
}
