<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Client;
use Faker\Generator as Faker;
use App\Http\Utilities\Country;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'site' => 'https://'.$faker->domainName,
        'country' => $faker->randomElement(Country::all()),
        'description' => $faker->text($maxNbChars = 200),
        'logo' => Client::DEFAULT_LOGO,
    ];
});
