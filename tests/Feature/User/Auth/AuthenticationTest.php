<?php

namespace Tests\Feature\User\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/user/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        /** @var \App\Models\User $user*/
        $user = User::factory()->create();

        $response = $this->post('/user/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->actingAs($user)->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::DASHBOARD);
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
