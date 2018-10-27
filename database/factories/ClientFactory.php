<?php

use Faker\Generator as Faker;
use App\Http\Utilities\Country;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'site' => 'https://'.$faker->domainName,
        'country' => $faker->randomElement(Country::all()),
        'description' => $faker->text($maxNbChars = 200),
        'logo' => 'logos/default.png',
    ];
});
