<?php

namespace Tests\Unit\Infrastructure\RepositoryImpl\Eloquent;

use App\Domains\Repositories;
use Faker;
use App\Infrastructure\DataAccess\Eloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleUserEntity;
use App\Infrastructure\RepositoryImpl\Eloquent\UserRepositoryImpl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryImplTest extends TestCase
{
    use RefreshDatabase;
    use ConvertibleUserEntity;

    protected Faker\Generator $faker;
    protected Repositories\UserRepository $userRepository;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = Faker\Factory::create();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = app(UserRepositoryImpl::class);
    }

    /**
     * @group getList
     */
    public function testGetList()
    {
        $expectedCount = 10;

        factory(Eloquent\User::class, $expectedCount)->create();

        $users = $this->userRepository->getList();

        $this->assertSame($expectedCount, count($users));
    }

    /**
     * @group findById
     */
    public function testFindByIdIfUserDoesntExist()
    {
        $userId = 1;

        $user = $this->userRepository->findById($userId);

        $this->assertNull($user);
    }

    /**
     * @group findById
     */
    public function testFindByIdIfUserExist()
    {
        $user = factory(Eloquent\User::class)->create();

        $user->load('articles.thumbnail');

        $expectedUserEntity = $this->toUserEntity($user->toArray());

        $actualUserEntity = $this->userRepository->findById($user->id);

        $this->assertEquals($expectedUserEntity, $actualUserEntity);
    }
}
