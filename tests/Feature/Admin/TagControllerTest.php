<?php

namespace Tests\Feature\Admin;

use App\Models\Tag;
use App\Models\Admin;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::factory()->create();
        $this->tag = Tag::factory()->create();
    }

    /**
     * タグ名が表示されているかどうか
     * @test
     */
    public function ログインしていればタグ一覧を表示()
    {
        $this->actingAs($this->admin, 'admins');

        $response = $this->get(route('admin.tag.index'));
        $response->assertStatus(200);
        $response->assertSeeText($this->tag->name);
    }

    /**
     * @test
     */
    public function ログインしていない状態でタグ一覧を表示する時ログイン画面へリダイレクトする()
    {
        $response = $this->get(route('admin.tag.index'));
        $response->assertRedirect(route('admin.login'));
    }

    /**
     * @test
     */
    public function ログインしていればタグの作成ができる()
    {
        $this->actingAs($this->admin, 'admins');

        $response = $this->post(route('admin.tag.store', [
            'name' => 'ほげほげ',
        ]));
        $response->assertRedirect(route('admin.tag.index'));
    }

    /**
     * @test
     */
    public function ログインしていない状態でタグを作成する時ログイン画面へリダイレクトする()
    {
        $response = $this->post(route('admin.tag.store', [
            'name' => 'ほげほげ',
        ]));
        $response->assertRedirect(route('admin.login'));
    }

    /**
     * @test
     */
    public function ログインしていればタグ編集画面を表示する()
    {
        $this->actingAs($this->admin, 'admins');

        $response = $this->get(route('admin.tag.edit', ['tag' => $this->tag]));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function ログインしていない状態でタグ編集画面へアクセスした時ログイン画面へリダイレクトされる()
    {
        $response = $this->get(route('admin.tag.edit', ['tag' => $this->tag->id]));
        $response->assertRedirect(route('admin.login'));
    }

    /**
     * 更新した後タグ一覧画面へリダイレクトしているか
     * @test
     */
    public function ログインしていればタグ内容を更新する()
    {
        $this->actingAs($this->admin, 'admins');

        $response = $this->put(route('admin.tag.update', [
            'name' => 'ほげほげ',
            'tag' => $this->tag->id,
        ]));
        $response->assertRedirect(route('admin.tag.index'));
    }

    /**
     * @test
     */
    public function ログインしていない状態でタグ内容を更新した時ログイン画面へリダイレクトする()
    {
        $response = $this->put(route('admin.tag.update', [
            'name' => 'ほげほげ',
            'tag' => $this->tag->id,
        ]));
        $response->assertRedirect(route('admin.login'));
    }
}
