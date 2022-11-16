<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\Article;
use App\Models\User;
use App\Models\Admin;

class ArticleControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::factory()->create();
    }

    /**
     * ユーザーの投稿と投稿者名の一覧が表示できているか
     * @test
     */
    public function ログインしていればユーザーの投稿一覧を表示()
    {
        $this->actingAs($this->admin, 'admins');

        $user = User::factory()->create();
        $article = Article::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('admin.article.index'));

        $response->assertSeeText($article->title);
        $response->assertSeeText($article->user->name);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function ログインしていない状態でユーザーの投稿一覧を表示する時ログイン画面へリダイレクト()
    {
        $response = $this->get(route('admin.article.index'));
        $response->assertRedirect(route('admin.login'));
    }
}
