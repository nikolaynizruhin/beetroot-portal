<?php

use Faker\Generator as Faker;
use App\Http\Utilities\Position;

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
    $userName = $faker->unique()->userName;

    return [
        'name' => $faker->name,
        'email' => $userName.'@beetroot.se',
        'avatar' => 'avatars/default.png',
        'position' => $faker->randomElement(Position::all()),
        'birthday' => $faker->date(),
        'accepted_at' => $faker->date(),
        'created_at' => $faker->date(),
        'phone' => $faker->e164PhoneNumber,
        'bio' => $faker->text($maxNbChars = 200),
        'slack' => $userName,
        'skype' => $userName,
        'github' => $userName,
        'facebook' => $userName,
        'instagram' => $userName,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'is_admin' => $faker->boolean,
        'remember_token' => str_random(10),
        'client_id' => function () {
            return factory(App\Client::class)->create()->id;
        },
        'office_id' => function () {
            return factory(App\Office::class)->create()->id;
        },
    ];
});

$factory->state(App\User::class, 'admin', [
    'is_admin' => true,
]);

$factory->state(App\User::class, 'employee', [
    'is_admin' => false,
]);

$factory->state(App\User::class, 'unacceptable', [
    'accepted_at' => null,
]);
