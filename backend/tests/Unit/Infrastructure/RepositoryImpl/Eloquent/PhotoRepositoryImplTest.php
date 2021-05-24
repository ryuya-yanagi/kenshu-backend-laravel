<?php

namespace Tests\Unit\Infrastructure\RepositoryImpl\Eloquent;

use App\Domains\Entities;
use App\Domains\Repositories;
use Faker;
use App\Infrastructure\DataAccess\Eloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\PhotoRepositoryImpl;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertiblePhotoEntity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PhotoRepositoryImplTest extends TestCase
{
    use RefreshDatabase;
    use ConvertiblePhotoEntity;

    protected Faker\Generator $faker;
    protected Repositories\PhotoRepository $photoRepository;
    protected Eloquent\Article $article;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = Faker\Factory::create();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->photoRepository = app(PhotoRepositoryImpl::class);

        $user = factory(Eloquent\User::class)->create();
        $this->article = factory(Eloquent\Article::class)->create([
            'user_id' => $user->id,
        ]);
    }

    /**
     * @group create
     */
    public function testCreate()
    {
        $this->assertTrue((new Eloquent\Photo())->newQuery()->get()->isEmpty());

        $url = $this->faker->text();

        $newPhotoEntity = new Entities\Photo((object) ["url" => $url, "article_id" => $this->article->id]);
        $actualPhotoEntity = $this->photoRepository->create($newPhotoEntity);

        $photo = (new Eloquent\Photo())->newQuery()->find($actualPhotoEntity->id);
        $expectedPhotoEntity = $this->toPhotoEntity($photo->toArray());

        $this->assertEquals($expectedPhotoEntity, $actualPhotoEntity);
    }

    /**
     * @group createValues
     */
    public function testCreateValues()
    {
        $this->assertTrue((new Eloquent\Photo())->newQuery()->get()->isEmpty());

        $expectedCount = 5;
        $url = $this->faker->text();

        $photoEntityCollections = [];
        for ($i = 0; $i < $expectedCount; $i++) {
            $photoEntity = new Entities\Photo((object) ["url" => $url, "article_id" => $this->article->id]);
            array_push($photoEntityCollections, $photoEntity);
        }

        $this->photoRepository->createValues($photoEntityCollections);

        $photos = (new Eloquent\Photo())->newQuery()->get();
        $actualCount = count($photos->toArray());

        $this->assertSame($expectedCount, $actualCount);
    }

    public function tearDown(): void
    {
        (new Eloquent\Article())->newQuery()->delete();
        (new Eloquent\User())->newQuery()->delete();
        parent::tearDown();
    }
}
