<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Infrastructure\DataAccess\Eloquent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginControllerTest extends TestCase
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

        $this->uri = route('login');
        $this->redirectUri = route('mypage');
    }

    public function testLoginNormal(): void
    {
        $response = $this->post($this->uri, $this->data);

        $response->assertRedirect($this->redirectUri);

        $this->assertAuthenticatedAs($this->auth);
    }

    public function testLoginWhenNameDoesNotMatch(): void
    {
        $this->data["name"] = 'test';
        $response = $this->post($this->uri, $this->data);

        $response->assertUnauthorized();
        $response->assertViewHas('unauthorized', 'ログインに失敗しました');
    }

    public function testLoginWhenPasswordDoesNotMatch(): void
    {
        $this->data["password"] = 'dummypassword';

        $response = $this->post($this->uri, $this->data);

        $response->assertUnauthorized();
        $response->assertViewHas('unauthorized', 'ログインに失敗しました');
    }

    public function tearDown(): void
    {
        (new Eloquent\Auth())->newQuery()->delete();
        parent::tearDown();
    }
}
