<?php

namespace Tests\Feature\Http\Controllers\Article;

use App\Infrastructure\DataAccess\Eloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleTagEntity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewControllerTest extends TestCase
{
    use RefreshDatabase;
    use ConvertibleTagEntity;

    protected Eloquent\Auth $auth;
    protected array $tagEntityCollections;

    protected string $uri;
    protected string $viewUri;

    public function setUp(): void
    {
        parent::setUp();

        $this->auth = factory(Eloquent\Auth::class)->create();

        $tags = factory(Eloquent\Tag::class, 3)->create();
        $this->tagEntityCollections = $this->toTagEntityCollection($tags->toArray());

        $this->uri = route('articles.new');
    }

    public function testNewNormal(): void
    {
        $response = $this->actingAs($this->auth)
            ->get($this->uri);

        $response->assertOk();
        $response->assertViewHas('tags', $this->tagEntityCollections);
    }

    public function testNewWhenGuest(): void
    {
        $response = $this->get($this->uri);

        $response->assertRedirect(route('login'));
    }

    public function tearDown(): void
    {
        (new Eloquent\Auth())->newQuery()->delete();
        (new Eloquent\Tag())->newQuery()->delete();
        parent::tearDown();
    }
}
