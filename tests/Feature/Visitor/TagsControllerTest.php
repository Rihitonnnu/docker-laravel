<?php

namespace Tests\Feature\Visitor;

use Tests\TestCase;

class TagsControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * 検索のpostを受け取りリダイレクトされているか
     * @test
     */
    public function 検索用のアクション()
    {
        $response = $this->get(route('visitor.article.index', ['keyword' => 'ほげほげ']));
        $response->assertStatus(200);
    }
}
