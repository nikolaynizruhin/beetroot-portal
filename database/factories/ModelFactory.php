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
    $userName = $faker->unique()->userName;
    $positions = \App\Http\Utilities\Position::all();
    $randKey = array_rand($positions);

    return [
        'name' => $faker->name,
        'email' => $userName . '@beetroot.se',
        'avatar' => 'avatars/default.jpg',
        'position' => $positions[$randKey],
        'birthday' => $faker->date(),
        'bio' => $faker->text($maxNbChars = 200),
        'slack' => $userName,
        'skype' => $userName,
        'github' => $userName,
        'password' => $password ?: $password = 'secret',
        'is_admin' => $faker->boolean,
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
        'site' => 'https://' . $faker->domainName,
        'country' => $faker->country,
        'description' => $faker->text($maxNbChars = 200),
        'logo' => 'logos/default.jpg'
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

