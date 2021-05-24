<?php

namespace Tests\Feature\Http\Controllers\Article;

use App\Infrastructure\DataAccess\Eloquent;
use Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateControllerTest extends TestCase
{
    use RefreshDatabase;

    protected Faker\Generator $faker;
    protected Eloquent\Auth $auth;
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

        $this->uri = route('articles.create');
    }

    public function testCreateNormal(): void
    {
        $data = [
            'title' => $this->faker->sentence(2),
            'body' => $this->faker->text(),
        ];

        $response = $this->actingAs($this->auth)
            ->post($this->uri, $data);

        $article = (new Eloquent\Article())->newQuery()->latest()->first();
        $redirectUri = route('articles.show', ['id' => $article->id]);

        $response->assertRedirect($redirectUri);
    }

    public function tearDown(): void
    {
        (new Eloquent\Article())->newQuery()->delete();
        (new Eloquent\Auth())->newQuery()->delete();
        parent::tearDown();
    }
}
