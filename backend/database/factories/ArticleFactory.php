<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Infrastructure\DataAccess\Eloquent\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2),
        'body' => $faker->realText()
    ];
});
