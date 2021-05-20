<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Infrastructure\DataAccess\Eloquent;
use Faker\Generator as Faker;

$factory->define(Eloquent\Photo::class, function (Faker $faker) {
    $article_id = (new Eloquent\Article())->newQuery()->get()->random();
    return [
        'url' => 'https://picsum.photos/seed/' . rand(1, 2000) . '/500/300',
        'article_id' => $article_id,
    ];
});
