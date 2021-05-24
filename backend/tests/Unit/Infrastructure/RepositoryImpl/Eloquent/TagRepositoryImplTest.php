<?php

namespace Tests\Unit\Infrastructure\RepositoryImpl\Eloquent;

use App\Domains\Entities;
use App\Domains\Repositories;
use Faker;
use App\Infrastructure\DataAccess\Eloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\TagRepositoryImpl;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleTagEntity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagRepositoryImplTest extends TestCase
{
    use RefreshDatabase;
    use ConvertibleTagEntity;

    protected Faker\Generator $faker;
    protected Repositories\TagRepository $tagRepository;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = Faker\Factory::create();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->tagRepository = app(TagRepositoryImpl::class);
    }

    /**
     * @group getList
     */
    public function testGetList()
    {
        $expectedCount = 10;

        factory(Eloquent\Tag::class, $expectedCount)->create();

        $tags = $this->tagRepository->getList();

        $this->assertSame($expectedCount, count($tags));
    }

    /**
     * @group findById
     */
    public function testFindByIdIfTagDoesntExist()
    {
        $maxInc = (new Eloquent\Tag())->newQuery()->get()->count() + 1;

        $tag = $this->tagRepository->findById($maxInc);

        $this->assertNull($tag);
    }

    /**
     * @group findById
     */
    public function testFindByIdIfTagExist()
    {
        $tag = factory(Eloquent\Tag::class)->create();

        $tag->load('articles');

        $expectedTagEntity = $this->toTagEntity($tag->toArray());

        $actualTagEntity = $this->tagRepository->findById($tag->id);

        $this->assertEquals($expectedTagEntity, $actualTagEntity);
    }

    /**
     * @group create
     */
    public function testCreate()
    {
        $this->assertTrue((new Eloquent\Tag())->newQuery()->get()->isEmpty());

        $name = $this->faker->sentence(2);

        $newTagEntity = new Entities\Tag((object) ["name" => $name]);
        $actualTagEntity = $this->tagRepository->create($newTagEntity);

        $tag = (new Eloquent\Tag())->newQuery()->find($actualTagEntity->id);
        $expectedTagEntity = $this->toTagEntity($tag->toArray());

        $this->assertEquals($expectedTagEntity, $actualTagEntity);
    }
}
