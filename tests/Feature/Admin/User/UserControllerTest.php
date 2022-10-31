<?php

namespace Tests\Feature\Admin\User;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;

class UserControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::factory()->create();
        $this->user = User::factory()->create();
    }

    /**
     * @test
     */
    public function ログインしていればユーザー一覧の表示()
    {
        $this->actingAs($this->admin, 'admins');

        $response = $this->get(route('admin.user.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.user.index');
    }

    /**
     * @test
     */
    public function ログインしていない状態でユーザー一覧画面へアクセスする時ログイン画面へリダイレクトする()
    {
        $response = $this->get(route('admin.user.index'));
        $response->assertRedirect(route('admin.login'));
    }

    /**
     * @test
     */
    public function ログインしていればユーザー詳細の表示()
    {
        $this->actingAs($this->admin, 'admins');

        $response = $this->get(route('admin.user.show', ['user' => $this->user->id]));
        $response->assertStatus(200);
        $response->assertViewIs('admin.user.show');
    }

    /**
     * @test
     */
    public function ログインしていない状態でユーザー詳細画面へアクセスする時ログイン画面へリダイレクトする()
    {
        $response = $this->get(route('admin.user.show', ['user' => $this->user->id]));
        $response->assertRedirect(route('admin.login'));
    }

    /**
     * @test
     */
    public function ログインしていればユーザー情報の編集画面が表示される()
    {
        $this->actingAs($this->admin, 'admins');

        $response = $this->get(route('admin.user.edit', ['user' => $this->user->id]));
        $response->assertStatus(200);
        $response->assertViewIs('admin.user.edit');
    }

    /**
     * @test
     */
    public function ログインしていない状態でユーザー編集画面へアクセスする時ログイン画面へリダイレクトする()
    {
        $response = $this->get(route('admin.user.edit', ['user' => $this->user->id]));
        $response->assertRedirect(route('admin.login'));
    }

    /**
     * @test
     */
    public function ログインしていればユーザー情報の更新ができる()
    {
        $this->actingAs($this->admin, 'admins');

        $response = $this->put(route('admin.user.update', ['user' => $this->user->id]));
        $response = $this->get(route('admin.user.index')); //更新後にユーザー一覧画面へリダイレクト
        $response->assertSessionHasNoErrors();
    }

    /**
     * @test
     */
    public function ログインしていない状態で更新処理を行う時ログイン画面へリダイレクトする()
    {
        $response = $this->put(route('admin.user.update', ['user' => $this->user->id]));
        $response->assertRedirect(route('admin.login'));
    }
}
