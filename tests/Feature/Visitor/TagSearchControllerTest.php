<?php

namespace Tests\Feature\Visitor;

use App\Models\Article;
use App\Models\Tag;
use Tests\TestCase;

class TagSearchControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * 検索したタグがついた投稿のタイトルが表示されているか、タグがついていない投稿のタイトルが表示されていないか
     * @test
     */
    public function タグの検索()
    {
        $tag = Tag::factory()->create(['name' => 'ほげほげ']);
        $article = Article::factory()->create();
        $otherArticle = Article::factory()->create();
        $article->tags()->sync([$tag->id]);

        $response = $this->post(route('visitor.article.search', ['keyword' => 'ほげほげ']));
        $response->assertStatus(200);
        $response->assertSeeText($article->title);
        $response->assertDontSeeText($otherArticle->title);
    }
}
