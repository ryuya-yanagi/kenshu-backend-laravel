<?php

namespace Tests\Feature\Http\Controllers\Article;

use App\Infrastructure\DataAccess\Eloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleTagEntity;
use Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewControllerTest extends TestCase
{
    use RefreshDatabase;
    use ConvertibleTagEntity;

    protected Faker\Generator $faker;
    protected Eloquent\Auth $auth;
    protected array $tagEntityCollections;

    protected string $uri;
    protected string $viewUri;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = Faker\Factory::create();
    }

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
}
