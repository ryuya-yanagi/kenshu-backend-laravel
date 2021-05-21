<?php

namespace Tests\Feature\Http\Controllers\Article;

use App\Domains\Entities;
use App\Infrastructure\DataAccess\Eloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleArticleEntity;
use Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditControllerTest extends TestCase
{
    use RefreshDatabase;
    use ConvertibleArticleEntity;

    protected Faker\Generator $faker;
    protected Eloquent\Auth $auth;
    protected Entities\Article $articleEntity;

    protected string $uri;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = Faker\Factory::create();
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->auth = factory(Eloquent\Auth::class)->create();

        $article = factory(Eloquent\Article::class)->create([
            'user_id' => $this->auth->id,
        ]);

        $article->load('user');

        $this->articleEntity = $this->toArticleEntity($article->toArray());

        $this->uri = route('articles.edit', ['id' => $this->articleEntity->id]);
    }

    public function testEditNormal(): void
    {
        $response = $this->actingAs($this->auth)
            ->get($this->uri);

        $response->assertOk();
        $response->assertViewHas('article', $this->articleEntity);
    }

    public function testEditWhenPermissionException(): void
    {
        $secondAuth = factory(Eloquent\Auth::class)->create();

        $response = $this->actingAs($secondAuth)
            ->get($this->uri);

        $response->assertForbidden();
    }
}
