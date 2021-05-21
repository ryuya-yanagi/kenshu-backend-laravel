<?php

namespace Tests\Unit\Infrastructure\DataAccess\Eloquent;

use App\Infrastructure\DataAccess\Eloquent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @group security
     */
    public function testCanAccessPasswordHash()
    {
        $auth = factory(Eloquent\Auth::class)->create();

        $actualAuth = (new Eloquent\Auth())->newQuery()->find($auth->id)->toArray();

        $this->assertTrue(array_key_exists('password_hash', $actualAuth));
    }
}
