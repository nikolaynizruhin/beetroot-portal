<?php

use App\User;
use Faker\Generator as Faker;
use App\Http\Utilities\Position;

$factory->define(User::class, function (Faker $faker) {
    $userName = $faker->unique()->userName;

    return [
        'name' => $faker->name,
        'gender' => $faker->randomElement(User::genders()),
        'email' => $userName.'@beetroot.se',
        'avatar' => User::DEFAULT_AVATAR,
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
