<?php

namespace Tests\Unit\Infrastructure\RepositoryImpl\Eloquent;

use App\Domains\Entities;
use App\Domains\Repositories;
use Faker;
use App\Infrastructure\DataAccess\Eloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\ArticleRepositoryImpl;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleArticleEntity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleRepositoryImplTest extends TestCase
{
    use RefreshDatabase;
    use ConvertibleArticleEntity;

    protected Faker\Generator $faker;
    protected Repositories\ArticleRepository $articleRepository;
    protected Eloquent\User $user;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = Faker\Factory::create();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->articleRepository = app(ArticleRepositoryImpl::class);

        $this->user = factory(Eloquent\User::class)->create();
    }

    /**
     * @group getList
     */
    public function testGetList()
    {
        $expectedCount = 10;

        factory(Eloquent\Article::class, $expectedCount)->create([
            "user_id" => $this->user->id,
        ]);

        $articles = $this->articleRepository->getList();

        $this->assertSame($expectedCount, count($articles));
    }

    /**
     * @group findById
     */
    public function testFindByIdIfArticleDoesntExist()
    {
        $maxInc = (new Eloquent\Article())->newQuery()->get()->count() + 1;;

        $article = $this->articleRepository->findById($maxInc);

        $this->assertNull($article);
    }

    /**
     * @group findById
     */
    public function testFindByIdIfArticleExist()
    {
        $article = factory(Eloquent\Article::class)->create([
            "user_id" => $this->user->id,
        ]);

        $article->load('user');

        $expectedArticleEntity = $this->toArticleEntity($article->toArray());

        $actualArticleEntity = $this->articleRepository->findById($article->id);

        $this->assertEquals($expectedArticleEntity, $actualArticleEntity);
    }

    /**
     * @group create
     */
    public function testCreate()
    {
        $this->assertTrue((new Eloquent\Article())->newQuery()->get()->isEmpty());

        $title = $this->faker->sentence(2);
        $body = $this->faker->text();

        $newArticleEntity = new Entities\Article((object) ["title" => $title, "body" => $body, "user_id" => $this->user->id]);
        $actualArticleEntity = $this->articleRepository->create($newArticleEntity);

        $article = (new Eloquent\Article())->newQuery()->find($actualArticleEntity->id);
        $expectedArticleEntity = $this->toArticleEntity($article->toArray());

        $this->assertEquals($expectedArticleEntity, $actualArticleEntity);
    }

    /**
     * @group update
     */
    public function testUpdate()
    {
        $article = factory(Eloquent\Article::class)->create([
            "user_id" => $this->user->id,
        ]);
        $articleEntity = $this->toArticleEntity($article->toArray());

        $title = $this->faker->sentence(2);
        $body = $this->faker->text();

        $articleEntity->setTitle($title);
        $articleEntity->setBody($body);

        $this->articleRepository->update($articleEntity);

        $article = (new Eloquent\Article())->newQuery()->find($articleEntity->id);

        $this->assertSame($title, $article->title);
        $this->assertSame($body, $article->body);
    }

    /**
     * @group delete
     */
    public function testDelete()
    {
        $article = factory(Eloquent\Article::class)->create(['user_id' => $this->user->id]);
        factory(Eloquent\Photo::class, 5)->create(['article_id' => $article->id]);

        $this->articleRepository->delete($article->id);

        $this->assertNull((new Eloquent\Article())->newQuery()->find($article->id));
        $this->assertTrue($article->photos()->get()->isEmpty());
    }

    public function tearDown(): void
    {
        (new Eloquent\User())->newQuery()->delete();
        parent::tearDown();
    }
}
