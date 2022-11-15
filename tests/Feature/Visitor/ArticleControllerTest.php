<?php

namespace Tests\Feature\Visitor;

use App\Models\Article;
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
        $article=Article::factory()->create();
        $response=$this->get(route('visitor.article.index'));

        $response->assertSeeText($article->title);
        $response->assertStatus(200);
    }
}
