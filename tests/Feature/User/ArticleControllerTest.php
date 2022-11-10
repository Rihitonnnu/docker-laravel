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

        $userArticle = Article::factory()->create(['user_id' => $this->user->id]); //自分の投稿分
        $otherUserArticle = Article::factory()->create(['user_id' => User::factory()->create()->id]); //他のユーザーの投稿分

        $response = $this->get(route('user.article.index'));

        $response->assertStatus(200);
        $response->assertSeeText($userArticle->title);
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

    /**
     * @test
     */
    public function ログインしていれば投稿作成画面へリダイレクトする()
    {
        $this->actingAs($this->user, 'users');

        $response = $this->get(route('user.article.create'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function ログインしていない状態で投稿作成画面を表示する時ログイン画面へリダイレクトする()
    {
        $response = $this->get(route('user.article.create'));
        $response->assertRedirect(route('user.login'));
    }

    /**
     * @test
     */
    public function ログインしていれば新規投稿内容の保存を行う()
    {
        $this->actingAs($this->user, 'users');

        $response = $this->post(route('user.article.store', [
            'title' => "ほげほげ",
            'content' => "ふがふが",
        ]));
        $response->assertRedirect(route('user.article.index'));
    }

    /**
     * @test
     */
    public function ログインしていない状態で新規投稿内容の保存を行う場合ログイン画面へリダイレクトする()
    {
        $response = $this->post(route('user.article.store'));
        $response->assertRedirect(route('user.login'));
    }

    /**
     * @test
     */
    public function ログインしていれば自分の投稿の詳細を表示する()
    {
        $this->actingAs($this->user, 'users');

        $article = Article::factory()->create(['user_id' => $this->user->id]); //自分の投稿、表示する
        $otherArticle = Article::factory()->create(['user_id' => $this->user->id]); //自分の投稿、表示しない
        $otherUserArticle = Article::factory()->create(); //他の人の投稿、表示しない

        $response = $this->get(route('user.article.show', ['article' => $article->id]));

        $response->assertSeeText($article->title);
        $response->assertDontSeeText($otherArticle);
        $response->assertDontSeeText($otherUserArticle);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function ログインしていない状態で投稿詳細を表示する場合ログイン画面へリダイレクトする()
    {
        $article = Article::factory()->create(['user_id' => $this->user->id]);

        $response = $this->get(route('user.article.show', ['article' => $article->id]));
        $response->assertRedirect(route('user.login'));
    }
}
