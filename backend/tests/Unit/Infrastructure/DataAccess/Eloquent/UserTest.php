<?php

namespace Tests\Unit\Infrastructure\DataAccess\Eloquent;

use App\Infrastructure\DataAccess\Eloquent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @group boot
     * 
     * @throws \Exception
     */
    public function testBootWhenDeletingUserWithArticlesShouldDelete()
    {
        $user = factory(Eloquent\User::class)->create();
        $user->articles()->saveMany(factory(Eloquent\Article::class, 10)->make());

        $this->assertTrue($user->articles()->get()->isNotEmpty());

        $user->delete();

        $this->assertTrue($user->articles()->get()->isEmpty());
    }

    /**
     * @group article
     */
    public function testArticles()
    {
        $users = factory(Eloquent\User::class, 3)->create();
        $users->each(function (Eloquent\User $user) {
            $user->articles()->saveMany(factory(Eloquent\Article::class, 10)->make());
        });

        $user = (new Eloquent\User())->newQuery()->get()->random();
        $articles = $user->articles()->get();

        $articles->each(function (Eloquent\Article $article) use ($user) {
            $this->assertSame((int) $user->id, (int) $article->user_id);
        });
    }
}
