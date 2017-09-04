<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'site' => 'https://' . $faker->domainName,
        'country' => $faker->country,
        'description' => $faker->text($maxNbChars = 200),
        'logo' => 'logos/default.jpg'
    ];
});