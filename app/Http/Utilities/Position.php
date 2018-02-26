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
        'Account Manager',
        'Administrative Coordinator',
        'Business Analyst',
        'Business Development Manager',
        'C Developer',
        'C#/.NET Developer',
        'C++ Developer',
        'CEO',
        'CFO',
        'CMO',
        'Content Manager',
        'Data Analyst',
        'Data Operator',
        'Designer',
        'DevOps',
        'Domain Specialist',
        'Finadmin Team Coordinator',
        'Financial Controller',
        'Financial Coordinator',
        'Financial Manager',
        'Founder',
        'Front-End Developer',
        'Full-Stack Developer',
        'Golang Developer',
        'HR',
        'Illustrator',
        'Java Developer',
        'JavaScript Developer',
        'Kotlin Developer',
        'Local Manager',
        'Marketing',
        'National Manager',
        'Node.js Developer',
        'Objective-C Developer',
        'Office Manager',
        'Operations Coordinator',
        'PHP Developer',
        'Project Coordinator',
        'Project Manager',
        'Python Developer',
        'QA Engineer',
        'Ruby/Rails Developer',
        'Sales Manager',
        'Scala Developer',
        'Swift Developer',
        'SysAdmin',
        'Unity Developer',
        'WordPress Developer',
        'Xamarin Developer',
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
