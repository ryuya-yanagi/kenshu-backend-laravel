<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Infrastructure\DataAccess\Eloquent\Auth;
use Faker\Generator as Faker;

$factory->define(Auth::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'password_hash' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
    ];
});
