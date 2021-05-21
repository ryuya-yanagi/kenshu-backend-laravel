<?php

namespace Tests\Unit\Infrastructure\RepositoryImpl\Eloquent;

use App\Domains\Entities;
use Faker;
use App\Domains\Repositories;
use App\Infrastructure\DataAccess\Eloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\AuthRepositoryImpl;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleAuthEntity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthRepositoryImplTest extends TestCase
{
    use RefreshDatabase;
    use ConvertibleAuthEntity;

    protected Faker\Generator $faker;
    protected Repositories\AuthRepository $authRepository;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = Faker\Factory::create();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->authRepository = app(AuthRepositoryImpl::class);
    }

    /**
     * @group findUserByName
     */
    public function testFindUserByNameIfUserDoesntExist()
    {
        $name = "dummy";

        $auth = $this->authRepository->findUserByName($name);

        $this->assertNull($auth);
    }

    /**
     * @group findUserByName
     */
    public function testFindUserByNameIfUserExist()
    {
        $auth = factory(Eloquent\Auth::class)->create();

        $expectedAuthEntity = $this->toAuthEntity($auth->toArray());

        $actualAuthEntity = $this->authRepository->findUserByName($auth->name);

        $this->assertEquals($expectedAuthEntity, $actualAuthEntity);
    }

    /**
     * @group create
     */
    public function testCreate()
    {
        $this->assertTrue((new Eloquent\Auth())->newQuery()->get()->isEmpty());

        $name = $this->faker->sentence(2);
        $password = $this->faker->password();

        $newAuthEntity = new Entities\Auth((object) ["name" => $name, "password_hash" => Hash::make($password)]);
        $actualAuthEntity = $this->authRepository->create($newAuthEntity);

        $auth = (new Eloquent\Auth())->newQuery()->find($actualAuthEntity->id);
        $expectedAuthEntity = $this->toAuthEntity($auth->toArray());

        $this->assertEquals($expectedAuthEntity, $actualAuthEntity);
    }
}
