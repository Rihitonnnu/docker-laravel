<?php

namespace Tests\Feature\Admin\Auth;

use App\Models\Admin;
use Tests\TestCase;
use App\Providers\RouteServiceProvider;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        /** @var \App\Models\Admin $admin*/
        $admin = Admin::factory()->create();

        $response = $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $this->actingAs($admin)->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::ADMIN_DASHBOARD);
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        /** @var \App\Models\Admin $admin*/
        $admin = Admin::factory()->create();

        $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
