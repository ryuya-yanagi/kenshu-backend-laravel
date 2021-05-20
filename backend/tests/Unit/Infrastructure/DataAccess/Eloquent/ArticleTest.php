<?php

namespace Tests\Unit\Infrastructure\DataAccess\Eloquent;

use App\Infrastructure\DataAccess\Eloquent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @group boot
     * 
     * @throws \Exception
     */
    public function testBootWhenDeletingArticleWithPhotosShouldDelete()
    {
        $article = factory(Eloquent\Article::class)->create();
        $article->photos()->saveMany(factory(Eloquent\Photo::class, 10)->make());

        $this->assertTrue($article->photos()->get()->isNotEmpty());

        $article->delete();

        $this->assertTrue($article->photos()->get()->isEmpty());
    }

    /**
     * @group article
     */
    public function testPhotos()
    {
        $articles = factory(Eloquent\Article::class, 3)->create();
        $articles->each(function (Eloquent\Article $article) {
            $article->photos()->saveMany(factory(Photo::class, 5)->make());
        });

        $article = (new Eloquent\article())->newQuery()->get()->random();
        $photos = $article->photos()->get();

        $photos->each(function (Eloquent\Photo $photo) use ($article) {
            $this->assertSame((int) $article->id, (int) $photo->article_id);
        });
    }
}
