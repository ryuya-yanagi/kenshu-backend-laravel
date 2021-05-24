<?php

namespace Tests\Feature\Http\Controllers\Article;

use App\Domains\Entities;
use App\Infrastructure\DataAccess\Eloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleArticleEntity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowControllerTest extends TestCase
{
    use RefreshDatabase;
    use ConvertibleArticleEntity;

    protected Entities\Article $articleEntity;

    protected string $uri;

    public function setUp(): void
    {
        parent::setUp();

        $user = factory(Eloquent\User::class)->create();

        $article = factory(Eloquent\Article::class)->create([
            'user_id' => $user->id,
        ]);

        factory(Eloquent\Photo::class, 3)->create([
            'article_id' => $article->id,
        ]);

        factory(Eloquent\Tag::class, 3)->create()->each(function (Eloquent\Tag $tag) use ($article) {
            $article->tags()->attach($tag->id);
        });

        $article->load('user');
        $article->load('tags');
        $article->load('photos');

        $this->articleEntity = $this->toArticleEntity($article->toArray());

        $this->uri = route('articles.show', ['id' => $this->articleEntity->id]);
    }

    public function testShowNormal(): void
    {
        $response = $this->get($this->uri);

        $response->assertOk();
        $response->assertViewHas('article', $this->articleEntity);
    }

    public function testShowWhenNotFound(): void
    {
        $maxInc = (new Eloquent\Article())->newQuery()->get()->count() + 1;

        $dummyUri = route('articles.show', ['id' => $maxInc]);
        $response = $this->get($dummyUri);

        $response->assertNotFound();
    }

    public function tearDown(): void
    {
        (new Eloquent\Photo())->newQuery()->delete();
        (new Eloquent\Article())->newQuery()->delete();
        (new Eloquent\User())->newQuery()->delete();
        (new Eloquent\Tag())->newQuery()->delete();
        parent::tearDown();
    }
}
