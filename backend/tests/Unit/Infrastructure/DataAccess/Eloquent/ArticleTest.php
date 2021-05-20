<?php

namespace Tests\Unit\Infrastructure\DataAccess\Eloquent;

use App\Infrastructure\DataAccess\Eloquent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    protected Eloquent\User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(Eloquent\User::class)->create();
    }

    /**
     * @group boot
     * 
     * @throws \Exception
     */
    public function testBootWhenDeletingArticleWithPhotosShouldDelete()
    {
        $article = factory(Eloquent\Article::class)->create([
            'user_id' => $this->user->id,
        ]);
        $article->photos()->saveMany(factory(Eloquent\Photo::class, 10)->make());

        $this->assertTrue($article->photos()->get()->isNotEmpty());

        $article->delete();

        $this->assertTrue($article->photos()->get()->isEmpty());
    }

    /**
     * @group boot
     * 
     * @throws \Exception
     */
    public function testBootWhenDeleteingArticleWithTagRelationsShouldDelete()
    {
        $article = factory(Eloquent\Article::class)->create([
            'user_id' => $this->user->id,
        ]);

        factory(Eloquent\Tag::class, 10)->create()->each(function (Eloquent\Tag $tag) use ($article) {
            $article->tags()->attach($tag->id);
        });

        $this->assertTrue($article->tags()->get()->isNotEmpty());

        $article->delete();

        $this->assertTrue($article->tags()->get()->isEmpty());
    }

    /**
     * @group photo
     */
    public function testPhotos()
    {
        $articles = factory(Eloquent\Article::class, 3)->create([
            'user_id' => $this->user->id,
        ]);
        $articles->each(function (Eloquent\Article $article) {
            $article->photos()->saveMany(factory(Eloquent\Photo::class, 5)->make());
        });

        $article = (new Eloquent\article())->newQuery()->get()->random();
        $photos = $article->photos()->get();

        $photos->each(function (Eloquent\Photo $photo) use ($article) {
            $this->assertSame((int) $article->id, (int) $photo->article_id);
        });
    }
}
