<?php

use Faker\Generator as Faker;
use App\Http\Utilities\Country;

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

$factory->define(App\Office::class, function (Faker $faker) {
    return [
        'city' => $faker->city,
        'country' => $faker->randomElement(Country::all()),
        'address' => $faker->streetAddress,
        'link' => 'Beetroot+Academy,Kiev',
    ];
});
