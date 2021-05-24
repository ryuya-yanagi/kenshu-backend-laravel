<?php

namespace Tests\Feature\Http\Controllers\Article;

use App\Domains\Entities;
use App\Infrastructure\DataAccess\Eloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleArticleEntity;
use Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateControllerTest extends TestCase
{
    use RefreshDatabase;
    use ConvertibleArticleEntity;

    protected Faker\Generator $faker;
    protected Eloquent\Auth $auth;
    protected Entities\Article $articleEntity;

    protected string $uri;
    protected string $redirectUri;
    protected array $data;

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

        $this->uri = route('articles.update', ['id' => $this->articleEntity->id]);
        $this->redirectUri = route('articles.show', ['id' => $this->articleEntity->id]);

        $title = $this->faker->sentence(2);
        $body = $this->faker->text();
        $this->data = [
            'title' => $title,
            'body' => $body,
        ];
    }

    public function testUpdateNormal(): void
    {
        $response = $this->actingAs($this->auth)
            ->patch($this->uri, $this->data);

        $response->assertRedirect($this->redirectUri);
    }

    public function testUpdateWhenPermissionException(): void
    {
        $secondAuth = factory(Eloquent\Auth::class)->create();

        $response = $this->actingAs($secondAuth)
            ->patch($this->uri, $this->data);

        $response->assertForbidden();
    }

    public function tearDown(): void
    {
        (new Eloquent\Article())->newQuery()->delete();
        (new Eloquent\User())->newQuery()->delete();
        parent::tearDown();
    }
}
