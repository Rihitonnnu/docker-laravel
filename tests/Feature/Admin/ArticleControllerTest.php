<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\Article;
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

        $article = Article::factory()->create();

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

    /**
     * 表示したい投稿・投稿者名が表示されているか、他の投稿が表示されていないか
     * @test
     */
    public function ログインしていればユーザーの投稿詳細表示()
    {
        $this->actingAs($this->admin, 'admins');

        $article = Article::factory()->create();
        $otherArticle = Article::factory()->create();

        $response = $this->get(route('admin.article.show', ['article' => $article->id]));

        $response->assertSeeText($article->title);
        $response->assertSeeText($article->user->name);

        $response->assertDontSeeText($otherArticle->title);
        $response->assertDontSeeText($otherArticle->user->name);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function ログインしていない状態で投稿詳細画面にアクセスした時ログイン画面へリダイレクトする()
    {
        $response = $this->get(route('admin.article.show', ['article' => Article::factory()->create()->id]));
        $response->assertRedirect(route('admin.login'));
    }

    /**
     * 投稿を削除して投稿一覧画面へ遷移されるか
     * @test
     */
    public function ログインしていれば投稿を削除()
    {
        $this->actingAs($this->admin, 'admins');

        $response = $this->delete(route('admin.article.destroy', ['article' => Article::factory()->create()->id]));
        $response->assertRedirect(route('admin.article.index'));
    }

    /**
     * @test
     */
    public function ログインしていない状態で投稿を削除した場合ログイン画面へリダイレクトする()
    {
        $response = $this->delete(route('admin.article.destroy', ['article' => Article::factory()->create()->id]));
        $response->assertRedirect(route('admin.login'));
    }
}
