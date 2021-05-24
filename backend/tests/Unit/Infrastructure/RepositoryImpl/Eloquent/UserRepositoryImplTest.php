<?php

namespace Tests\Unit\Infrastructure\RepositoryImpl\Eloquent;

use App\Domains\Repositories;
use App\Infrastructure\DataAccess\Eloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleUserEntity;
use App\Infrastructure\RepositoryImpl\Eloquent\UserRepositoryImpl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryImplTest extends TestCase
{
    use RefreshDatabase;
    use ConvertibleUserEntity;

    protected Repositories\UserRepository $userRepository;

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
        $maxInc = (new Eloquent\User())->newQuery()->get()->count() + 1;

        $user = $this->userRepository->findById($maxInc);

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
