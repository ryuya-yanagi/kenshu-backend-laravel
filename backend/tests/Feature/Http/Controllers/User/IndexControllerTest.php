<?php

namespace Tests\Feature\Http\Controllers\User;

use App\Infrastructure\DataAccess\Eloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleUserEntity;
use Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use RefreshDatabase;
    use ConvertibleUserEntity;

    protected Faker\Generator $faker;
    protected array $userEntityCollection;

    protected string $uri;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = Faker\Factory::create();
    }

    public function setUp(): void
    {
        parent::setUp();

        $users = factory(Eloquent\User::class, 3)->create();

        $this->userEntityCollection = $this->toUserEntityCollection($users->toArray());

        $this->uri = route('users.index');
    }

    public function testIndexNormal(): void
    {
        $response = $this->get($this->uri);

        $response->assertOk();
        $response->assertViewHas('users', $this->userEntityCollection);
    }
}
