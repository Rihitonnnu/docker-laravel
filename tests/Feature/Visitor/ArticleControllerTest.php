<?php

namespace Tests\Feature\Visitor;

use App\Models\Article;
use App\Models\User;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function 投稿一覧を表示()
    {
        $article = Article::factory()->create();
        $response = $this->get(route('visitor.article.index'));

        $response->assertSeeText($article->title);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function 投稿詳細を表示()
    {
        $user = User::factory()->create(); //表示する投稿の作成者
        $otherUser = User::factory()->create(); //表示しない投稿の作成者

        $article = Article::factory()->create(['user_id' => $user->id]); //表示する投稿
        $otherArticle = Article::factory()->create(['user_id' => $otherUser->id]); //表示しない投稿

        $response = $this->get(route('visitor.article.show', ['article' => $article->id, 'userName' => $user->name]));

        $response->assertSeeText($article->title); //表示したい投稿のタイトルが表示されているか
        $response->assertSeeText($user->name); //表示したい投稿の作成者の名前が表示されているか

        $response->assertDontSeeText($otherArticle->title); //表示しない投稿のタイトルが表示されていないか
        $response->assertDontSeeText($otherUser->name); //表示しない投稿の作成者の名前が表示されていないか
        $response->assertStatus(200);
    }
}
