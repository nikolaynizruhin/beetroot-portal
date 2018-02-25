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
        'Front-End Developer',
        'Full-Stack Developer',
        'Xamarin Developer',
        'Node.js Developer',
        'Ruby/Rails Developer',
        'PHP Developer',
        'WordPress Developer',
        'Swift Developer',
        'Objective-C Developer',
        'Java Developer',
        'Scala Developer',
        'Kotlin Developer',
        'Golang Developer',
        'C++ Developer',
        'C#/.NET Developer',
        'C Developer',
        'Unity Developer',
        'Business Analyst',
        'Data Analyst',
        'Data Operator',
        'Project Manager',
        'Project Coordinator',
        'Administrative Coordinator',
        'Operations Coordinator',
        'Business Development Manager',
        'Local Manager',
        'Office Manager',
        'Account Manager',
        'Content Manager',
        'Domain Specialist',
        'National Manager',
        'Finadmin Team Coordinator',
        'Financial Controller',
        'Financial Coordinator',
        'Financial Manager',
        'Sales Manager',
        'Marketing',
        'HR',
        'DevOps',
        'SysAdmin',
        'Designer',
        'Illustrator',
        'QA Engineer',
        'Founder',
        'CEO',
        'CFO',
        'CMO',
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
