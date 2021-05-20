<?php

use App\Infrastructure\DataAccess\Eloquent\Article;
use Illuminate\Database\Seeder;

class ThumbnailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = (new Article())->newQuery()->get();

        $articles->each(function (Article $article) {
            $firstPhoto = $article->photos()->take(1)->get();
            if (!count($firstPhoto)) return;

            $article->update([
                'thumbnail_id' => $firstPhoto[0]->id,
            ]);
        });
    }
}
