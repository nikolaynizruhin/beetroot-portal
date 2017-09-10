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

$factory->define(App\User::class, function (Faker $faker) {
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
        'password' => $password ?: $password = bcrypt('secret'),
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

$factory->state(App\User::class, 'admin', [
    'is_admin' => true,
]);
