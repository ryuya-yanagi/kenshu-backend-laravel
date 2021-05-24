<?php

namespace Tests\Feature\Http\Controllers\Tag;

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

        $this->uri = route('tags.create');

        $this->data = ['name' => $this->faker->sentence(2)];
    }

    public function testCreateNormal(): void
    {

        $response = $this->actingAs($this->auth)
            ->post($this->uri, $this->data);

        $tag = (new Eloquent\Tag())->newQuery()->latest()->first();
        $redirectUri = route('tags.show', ['id' => $tag->id]);

        $response->assertRedirect($redirectUri);
    }

    public function tearDown(): void
    {
        (new Eloquent\Auth())->newQuery()->delete();
        parent::tearDown();
    }
}
