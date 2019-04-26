<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Office;
use Faker\Generator as Faker;
use App\Http\Utilities\Country;

$factory->define(Office::class, function (Faker $faker) {
    return [
        'city' => $faker->city,
        'country' => $faker->randomElement(Country::all()),
        'address' => $faker->streetAddress,
        'link' => 'Beetroot+Academy,Kiev',
    ];
});
