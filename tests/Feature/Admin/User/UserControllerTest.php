<?php

namespace Tests\Feature\Admin\User;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;

class UserControllerTest extends TestCase
{
    /**
     * @test
     */
    public function ログインしていればユーザー一覧の表示()
    {
        /** @var \App\Models\Admin $admin*/
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admins');

        $response = $this->get(route('admin.user.index'));
        $response->assertOk();

        $response->assertViewIs('admin.user.index');
    }

    /**
     * @test
     */
    public function ログインしていればユーザー詳細の表示()
    {
        /** @var \App\Models\Admin $admin*/
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admins');

        $user = User::factory()->create();
        $response = $this->get(route('admin.user.show', ['user' => $user->id]));

        $response->assertOk();
        $response->assertViewIs('admin.user.show');
    }

    /**
     * @test
     */
    public function ログインしていればユーザー情報の編集画面が表示される()
    {
        /** @var \App\Models\Admin $admin*/
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admins');

        $user = User::factory()->create();

        //編集画面
        $response = $this->get(route('admin.user.edit', ['user' => $user->id]));
        $response->assertOk();
        $response->assertViewIs('admin.user.edit');
    }

    /**
     * @test
     */
    public function ログインしていればユーザー情報の更新ができる()
    {
        /** @var \App\Models\Admin $admin*/
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admins');

        $user = User::factory()->create();

        //更新テスト用のデータ
        $updateData = [
            'name' => 'test',
            'email' => 'test@gmail.com',
        ];

        $response = $this->put(route('admin.user.update', ['user' => $user->id]), $updateData);
        $response = $this->get(route('admin.user.index')); //更新後にユーザー一覧画面へリダイレクト
        $response->assertSessionHasNoErrors();
    }

    /**
     * @test
     */
    public function ログインしていなければ管理者のログイン画面へリダイレクトされる()
    {
        //一覧画面にログインなしでアクセスした場合
        $response = $this->get(route('admin.user.index'));
        $response->assertRedirect(route('admin.login'));

        $user = User::factory()->create();
        $response = $this->get(route('admin.user.show', ['user' => $user->id]));
        $response->assertRedirect(route('admin.login'));

        $response = $this->get(route('admin.user.edit', ['user' => $user->id]));
        $response->assertRedirect(route('admin.login'));

        //更新テスト用のデータ
        $updateData = [
            'name' => 'test',
            'email' => 'test@gmail.com',
        ];

        $response = $this->put(route('admin.user.update', ['user' => $user->id]), $updateData);
        $response->assertRedirect(route('admin.login'));
    }
}
