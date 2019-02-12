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
        'Administration',
        'Annotator',
        'Business Analyst',
        'Business Development',
        'Business Development/Legal',
        'C Developer',
        'C#/.NET Developer',
        'C++ Developer',
        'Content Manager',
        'Data Analyst',
        'Data Operator',
        'Designer',
        'DevOps',
        'Domain Specialist',
        'Finance',
        'Finance/Administration',
        'Founder/CEO',
        'Founder/Finance',
        'Front-End Developer',
        'Full-Stack Developer',
        'Golang Developer',
        'HR',
        'Illustrator',
        'Intern',
        'Java Developer',
        'JavaScript Developer',
        'Kotlin Developer',
        'Legal',
        'Local Management',
        'Marketing',
        'Node.js Developer',
        'Objective-C Developer',
        'Office Manager',
        'PHP Developer',
        'Product Team',
        'Project Coordination',
        'Project Manager',
        'Python Developer',
        'QA Automation Engineer',
        'QA Engineer',
        'Ruby/Rails Developer',
        'Sales Manager',
        'Scala Developer',
        'Site Builder',
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
}
