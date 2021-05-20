<?php

use App\Infrastructure\DataAccess\Eloquent;
use Illuminate\Database\Seeder;

class ArticlesTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = (new Eloquent\Article())->newQuery()->get();

        $articles->each(function (Eloquent\Article $article) {
            $tags = (new Eloquent\Tag())->newQuery()->get()->random(mt_rand(1, 5));
            $tags->each(function (Eloquent\Tag $tag) use ($article) {
                $article->tags()->attach($tag->id);
            });
        });
    }
}
