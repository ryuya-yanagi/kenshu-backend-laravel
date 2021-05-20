<?php

namespace Tests\Feature\Auth;

use App\Infrastructure\DataAccess\Eloquent\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected Auth $auth;
    protected $password = 'password';

    public function setUp(): void
    {
        parent::setUp();

        $this->auth = Auth::create(["name" => 'testuser', "password_hash" => Hash::make($this->password)]);
    }

    public function testLogin(): void
    {
        $response = $this->post(route('login'), [
            'name' => 'testuser',
            'password' => $this->password,
        ]);

        $response->assertRedirect('/mypage');

        $this->assertAuthenticatedAs($this->auth);
    }
}
