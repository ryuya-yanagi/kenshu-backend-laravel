<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Infrastructure\DataAccess\Eloquent\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'password_hash' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
    ];
});
