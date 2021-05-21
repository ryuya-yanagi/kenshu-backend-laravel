<?php

namespace Tests\Feature\Http\Controllers\Article;

use App\Infrastructure\DataAccess\Eloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleArticleEntity;
use Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use RefreshDatabase;
    use ConvertibleArticleEntity;

    protected Faker\Generator $faker;
    protected Eloquent\User $user;
    protected array $articleEntityCollection;

    protected string $uri;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = Faker\Factory::create();
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(Eloquent\User::class)->create();

        $articles = factory(Eloquent\Article::class, 10)->create([
            'user_id' => $this->user->id,
        ]);

        $articles->each(function ($article) {
            $article->load('user');
            $article->load('tags');
            $article->load('photos');
        });

        $this->articleEntityCollection = $this->toArticleEntityCollection($articles->toArray());

        $this->uri = route('articles.index');
    }

    public function testIndexNormal(): void
    {
        $response = $this->get($this->uri);

        $response->assertOk();
        $response->assertViewHas('articles', $this->articleEntityCollection);
    }
}
