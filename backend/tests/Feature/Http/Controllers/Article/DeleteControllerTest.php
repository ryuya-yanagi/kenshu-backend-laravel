<?php

namespace Tests\Feature\Http\Controllers\Article;

use App\Infrastructure\DataAccess\Eloquent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteControllerTest extends TestCase
{
    use RefreshDatabase;

    protected Eloquent\Auth $auth;
    protected Eloquent\Article $article;

    protected string $uri;
    protected string $redirectUri;

    public function setUp(): void
    {
        parent::setUp();

        $this->auth = factory(Eloquent\Auth::class)->create();
        $this->article = factory(Eloquent\Article::class)->create([
            'user_id' => $this->auth->id,
        ]);

        $this->uri = route('articles.delete', ['id' => $this->article->id]);
        $this->redirectUri = route('mypage');
    }

    public function testDeleteNormal(): void
    {
        $response = $this->actingAs($this->auth)
            ->delete($this->uri);

        $response->assertRedirect($this->redirectUri);
    }

    public function testDeleteWhenPermissionException(): void
    {
        $secondAuth = factory(Eloquent\Auth::class)->create();

        $response = $this->actingAs($secondAuth)
            ->delete($this->uri);

        $response->assertForbidden();
    }

    public function tearDown(): void
    {
        (new Eloquent\Article())->newQuery()->delete();
        (new Eloquent\Auth())->newQuery()->delete();
        parent::tearDown();
    }
}
