<?php

namespace Tests\Feature;

use App\Models\Article;
use Tests\TestCase;
use App\Models\User;

class ArticleControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * @test
     */
    public function ログインしていれば自分が投稿した記事の一覧を表示する()
    {
        $this->actingAs($this->user, 'users');

        $sameUserArticle = Article::factory()->create(['user_id' => $this->user->id]); //自分の投稿分
        $otherUserArticle = Article::factory()->create(['user_id' => User::factory()->create()->id]); //他のユーザーの投稿分

        $response = $this->get(route('user.article.index'));

        $response->assertStatus(200);
        $response->assertSeeText($sameUserArticle->title);
        $response->assertDontSeeText($otherUserArticle->title);

        $response->assertViewIs('user.article.index');
    }

    /**
     * @test
     */
    public function ログインしていない状態で投稿一覧を表示する時ログイン画面へリダイレクトする()
    {
        $response = $this->get(route('user.article.index'));
        $response->assertRedirect(route('user.login'));
    }
}
