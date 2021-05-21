<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Infrastructure\DataAccess\Eloquent\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->sentence(2)
    ];
});
