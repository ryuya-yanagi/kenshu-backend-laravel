<?php

namespace Tests\Feature\Http\Controllers\Article;

use App\Infrastructure\DataAccess\Eloquent;
use Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteControllerTest extends TestCase
{
    use RefreshDatabase;

    protected Faker\Generator $faker;
    protected Eloquent\Auth $auth;
    protected Eloquent\Article $article;

    protected string $uri;
    protected string $redirectUri;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = Faker\Factory::create();
    }

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
}
