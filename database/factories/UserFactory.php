<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\User;
use App\Client;
use App\Office;
use Illuminate\Support\Str;
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
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'is_admin' => $faker->boolean,
        'remember_token' => Str::random(10),
        'client_id' => factory(Client::class),
        'office_id' => factory(Office::class),
    ];
});

$factory->state(User::class, 'admin', [
    'is_admin' => true,
]);

$factory->state(User::class, 'employee', [
    'is_admin' => false,
]);

$factory->state(User::class, 'unacceptable', [
    'accepted_at' => null,
]);
