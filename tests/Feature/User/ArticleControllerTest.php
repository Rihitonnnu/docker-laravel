<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Tag;
use Tests\TestCase;
use App\Models\User;

class ArticleControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->tag = Tag::factory()->create();
    }

    /**
     * 自分の投稿のタイトル・タグが表示されているか、他人の投稿のタイトルが表示されていないか
     * @test
     */
    public function ログインしていれば自分が投稿した記事の一覧を表示する()
    {
        $this->actingAs($this->user, 'users');

        $article = Article::factory()->create(['user_id' => $this->user->id]); //自分の投稿分
        $otherArticle = Article::factory()->create(['user_id' => User::factory()->create()->id]); //他のユーザーの投稿分

        $article->tags()->sync([$this->tag->id]);

        $response = $this->get(route('user.article.index'));

        $response->assertStatus(200);
        $response->assertSeeText($article->title);
        $response->assertSeeText($this->tag->name);
        $response->assertDontSeeText($otherArticle->title);

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
        $tag = Tag::factory()->create();

        $response = $this->post(route('user.article.store', [
            'title' => "ほげほげ",
            'content' => "ふがふが",
            'tags' => [$tag->id],
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
     * 選択した自分の投稿のタイトル・タグが表示されているか、選択していない投稿・他のユーザーの投稿が表示されていないか
     * @test
     */
    public function ログインしていれば自分の投稿の詳細を表示する()
    {
        $this->actingAs($this->user, 'users');

        $article = Article::factory()->create(['user_id' => $this->user->id]); //自分の投稿、表示する
        $otherArticle = Article::factory()->create(['user_id' => $this->user->id]); //自分の投稿、表示しない
        $otherUserArticle = Article::factory()->create(); //他の人の投稿、表示しない

        $article->tags()->sync([$this->tag->id]);

        $response = $this->get(route('user.article.show', ['article' => $article->id]));

        $response->assertSeeText($article->title);
        $response->assertSeeText($this->tag->name);
        $response->assertDontSeeText($otherArticle->title);
        $response->assertDontSeeText($otherUserArticle->title);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function ログインしていない状態で投稿詳細を表示する場合ログイン画面へリダイレクトする()
    {
        $response = $this->get(route('user.article.show', ['article' => Article::factory()->create(['user_id' => $this->user->id])->id]));
        $response->assertRedirect(route('user.login'));
    }

    /**
     * @test
     */
    public function ログインしていれば投稿編集画面を表示する()
    {
        $this->actingAs($this->user, 'users');

        $article = Article::factory()->create(['user_id' => $this->user->id]); //表示する投稿
        $otherArticle = Article::factory()->create(); //表示しない投稿

        $response = $this->get(route('user.article.edit', ['article' => $article->id]));
        $response->assertSeeText($article->content);
        $response->assertDontSeeText($otherArticle->content);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function ログインしていない状態で投稿編集画面へアクセスした時ログイン画面へリダイレクトする()
    {
        $response = $this->get(route('user.article.edit', ['article' => Article::factory()->create(['user_id' => $this->user->id])->id]));
        $response->assertRedirect(route('user.login'));
    }

    /**
     * @test
     */
    public function ログインしていれば投稿内容を更新する()
    {
        $this->actingAs($this->user, 'users');

        $response = $this->put(route('user.article.update', [
            'title' => 'タイトル',
            'content' => '本文',
            'article' => Article::factory()->create(['user_id' => $this->user->id])->id,
        ]));
        $response->assertRedirect(route('user.article.index'));
    }

    /**
     * @test
     */
    public function ログインしていない状態で投稿内容を更新した時ログイン画面へリダイレクトする()
    {
        $response = $this->put(route('user.article.update', [
            'title' => 'タイトル',
            'content' => '本文',
            'article' => Article::factory()->create(['user_id' => $this->user->id])->id,
        ]));
        $response->assertRedirect(route('user.login'));
    }

    /**
     * @test
     */
    public function ログインしていれば自分の投稿を削除する()
    {
        $this->actingAs($this->user, 'users');

        $response = $this->delete(route('user.article.destroy', ['article' => Article::factory()->create(['user_id' => $this->user->id])->id]));
        $response->assertRedirect(route('user.article.index'));
    }

    /**
     * @test
     */
    public function ログインしていない状態で投稿を削除した時ログイン画面へリダイレクトする()
    {
        $response = $this->delete(route('user.article.destroy', ['article' => Article::factory()->create()->id]));
        $response->assertRedirect(route('user.login'));
    }
}
