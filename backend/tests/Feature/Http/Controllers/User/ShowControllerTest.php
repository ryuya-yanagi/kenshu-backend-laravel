<?php

namespace Tests\Feature\Http\Controllers\User;

use App\Domains\Entities;
use App\Infrastructure\DataAccess\Eloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleUserEntity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowControllerTest extends TestCase
{
    use RefreshDatabase;
    use ConvertibleUserEntity;

    protected Entities\User $userEntity;

    protected string $uri;

    public function setUp(): void
    {
        parent::setUp();

        $user = factory(Eloquent\User::class)->create();
        factory(Eloquent\Article::class, 5)->create([
            'user_id' => $user->id,
        ]);

        $user->load('articles');

        $this->userEntity = $this->toUserEntity($user->toArray());

        $this->uri = route('users.show', ['id' => $this->userEntity->id]);
    }

    public function testShowNormal(): void
    {
        $response = $this->get($this->uri);

        $response->assertOk();
        $response->assertViewHas('user', $this->userEntity);
    }

    public function testShowWhenNotFound(): void
    {
        $maxInc = (new Eloquent\User())->newQuery()->get()->count() + 1;

        $dummyUri = route('users.show', ['id' => $maxInc]);
        $response = $this->get($dummyUri);

        $response->assertNotFound();
    }

    public function tearDown(): void
    {
        (new Eloquent\Article())->newQuery()->delete();
        (new Eloquent\User())->newQuery()->delete();
        parent::tearDown();
    }
}
