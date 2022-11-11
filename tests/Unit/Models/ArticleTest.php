<?php

namespace Tests\Unit\Models;

use App\Models\Article;
use App\Models\User;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    protected function setup(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_storeArticle()
    {
        $article = (new Article())->storeArticle($this->user->id, 'ほげほげ', 'ふがふが');

        $this->assertEquals($this->user->id, $article->user_id);
        $this->assertEquals('ほげほげ', $article->title);
        $this->assertEquals('ふがふが', $article->content);
    }

    public function test_updateArticle()
    {
        $updateArticle = (new Article())->updateArticle('タイトル', '本文', Article::factory()->create()->id);

        $this->assertEquals('タイトル', $updateArticle->title);
        $this->assertEquals('本文', $updateArticle->content);
    }

    public function test_destroyArticle()
    {
        $article = Article::factory()->create();
        (new Article())->destroyArticle($article->id);

        $this->assertSoftDeleted($article);
    }
}
