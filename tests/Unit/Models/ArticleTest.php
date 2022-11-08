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
        $this->user = User::factory()->create(['id' => 1]);
    }

    public function test_storeArticle()
    {
        $storeArticle = (new Article())->storeArticle($this->user->id, 'ほげほげ', 'ふがふが');

        $this->assertEquals($this->user->id, $storeArticle->user_id);
        $this->assertEquals('ほげほげ', $storeArticle->title);
        $this->assertEquals('ふがふが', $storeArticle->content);
    }
}
