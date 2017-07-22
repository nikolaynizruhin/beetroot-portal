<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'avatar' => $faker->imageUrl($width = 300, $height = 300, 'people'),
        'position' => $faker->jobTitle,
        'birthday' => $faker->date(),
        'password' => $password ?: $password = 'secret',
        'remember_token' => str_random(10),
        'client_id' => function () {
            return factory(App\Client::class)->create()->id;
        },
        'office_id' => function () {
            return factory(App\Office::class)->create()->id;
        }
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Client::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->company,
        'site' => $faker->url,
        'country' => $faker->country,
        'description' => $faker->text($maxNbChars = 200),
        'logo' => $faker->imageUrl($width = 300, $height = 300, 'business')
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Office::class, function (Faker\Generator $faker) {

    return [
        'city' => $faker->city,
        'country' => $faker->country,
        'address' => $faker->streetAddress
    ];
});

