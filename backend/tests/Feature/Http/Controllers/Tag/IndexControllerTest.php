<?php

namespace Tests\Feature\Http\Controllers\Tag;

use App\Infrastructure\DataAccess\Eloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleTagEntity;
use Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use RefreshDatabase;
    use ConvertibleTagEntity;

    protected Faker\Generator $faker;
    protected array $tagEntityCollection;

    protected string $uri;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = Faker\Factory::create();
    }

    public function setUp(): void
    {
        parent::setUp();

        $tags = factory(Eloquent\Tag::class, 10)->create();

        $this->tagEntityCollection = $this->toTagEntityCollection($tags->toArray());

        $this->uri = route('tags.index');
    }

    public function testIndexNormal(): void
    {
        $response = $this->get($this->uri);

        $response->assertOk();
        $response->assertViewHas('tags', $this->tagEntityCollection);
    }
}
