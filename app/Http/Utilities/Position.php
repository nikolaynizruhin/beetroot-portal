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
        'Financial Manager',
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
     * Get positions csv.
     *
     * @return array
     */
    public static function csv()
    {
        return implode(',', static::$positions);
    }
}
