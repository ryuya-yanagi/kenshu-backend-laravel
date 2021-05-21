<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Infrastructure\DataAccess\Eloquent\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    protected Auth $auth;

    protected string $uri;
    protected string $redirectUri;
    protected array $data;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->data = [
            'name' => 'testuser',
            'password' => 'password',
        ];

        $this->auth = Auth::create(['name' => $this->data['name'], 'password_hash' => Hash::make($this->data['password'])]);

        $this->uri = route('register');
    }

    public function testRegisterNormal(): void
    {
        $response = $this->post($this->uri, $this->data);

        $response->assertRedirect('/');
    }

    public function testRegisterWhenUserIsNotGuest(): void
    {
        $response = $this->actingAs($this->auth)
            ->post($this->uri, $this->data);

        $response->assertRedirect(route('mypage'));
    }
}
