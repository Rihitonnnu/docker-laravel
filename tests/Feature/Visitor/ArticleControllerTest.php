<?php

namespace Tests\Feature\Visitor;

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->tag = Tag::factory()->create();
    }

    /**
     * 投稿のタイトルと投稿者名、タグが表示されているか
     * @test
     */
    public function 投稿一覧を表示()
    {
        $article = Article::factory()->create();

        $article->tags()->sync([$this->tag->id]);

        $response = $this->get(route('visitor.article.index'));

        $response->assertSeeText($article->title);
        $response->assertSeeText($article->user->name);
        $response->assertSeeText($this->tag->name);

        $response->assertStatus(200);
    }

    /**
     * 表示したい投稿・投稿者名・タグが表示されているか、他の投稿・投稿者名が表示されていないか
     * @test
     */
    public function 投稿詳細を表示()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $article = Article::factory()->create(['user_id' => $user->id]);
        $otherArticle = Article::factory()->create(['user_id' => $otherUser->id]);

        $otherTag = Tag::factory()->create();
        $article->tags()->sync([$this->tag->id]);

        $response = $this->get(route('visitor.article.show', ['article' => $article->id]));

        $response->assertSeeText($article->title);
        $response->assertSeeText($user->name);
        $response->assertSeeText($this->tag->name);

        $response->assertDontSeeText($otherArticle->title);
        $response->assertDontSeeText($otherUser->name);
        $response->assertStatus(200);
    }
}
