<?php

namespace Tests\Feature\Http\Controllers\Tag;

use App\Domains\Entities;
use App\Infrastructure\DataAccess\Eloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleTagEntity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowControllerTest extends TestCase
{
    use RefreshDatabase;
    use ConvertibleTagEntity;

    protected Entities\Tag $tagEntity;

    protected string $uri;

    public function setUp(): void
    {
        parent::setUp();

        $user = factory(Eloquent\User::class)->create();

        $tag = factory(Eloquent\Tag::class)->create();

        factory(Eloquent\Article::class, 10)->create([
            'user_id' => $user->id,
        ])->each(function (Eloquent\Article $article) use ($tag) {
            $article->tags()->attach($tag->id);
        });

        $tag->load('articles.thumbnail');
        $tag->load('articles.user');

        $this->tagEntity = $this->toTagEntity($tag->toArray());

        $this->uri = route('tags.show', ['id' => $this->tagEntity->id]);
    }

    public function testShowNormal(): void
    {
        $response = $this->get($this->uri);

        $response->assertOk();
        $response->assertViewHas('tag', $this->tagEntity);
    }

    public function testShowWhenNotFound(): void
    {
        $maxInc = (new Eloquent\Tag())->newQuery()->get()->count() + 1;

        $dummyUri = route('articles.show', ['id' => $maxInc]);
        $response = $this->get($dummyUri);

        $response->assertNotFound();
    }

    public function tearDown(): void
    {
        (new Eloquent\Article())->newQuery()->delete();
        (new Eloquent\User())->newQuery()->delete();
        (new Eloquent\Tag())->newQuery()->delete();
        parent::tearDown();
    }
}
