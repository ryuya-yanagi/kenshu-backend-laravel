<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Infrastructure\DataAccess\Eloquent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LogoutControllerTest extends TestCase
{
    use RefreshDatabase;

    protected Eloquent\Auth $auth;

    protected string $uri;
    protected string $redirectUri;
    protected array $data;

    public function setUp(): void
    {
        parent::setUp();

        $this->data = [
            'name' => 'testuser',
            'password' => 'password',
        ];

        $this->auth = Eloquent\Auth::create(['name' => $this->data['name'], 'password_hash' => Hash::make($this->data['password'])]);

        $this->uri = route('logout');
        $this->redirectUri = route('top');
    }

    public function testLogoutNormal(): void
    {
        $response = $this->actingAs($this->auth)->get($this->uri);

        $response->assertRedirect($this->redirectUri);
    }

    public function tearDown(): void
    {
        (new Eloquent\Auth())->newQuery()->delete();
        parent::tearDown();
    }
}
