<?php

namespace Tests\Feature\Visitor;

use Tests\TestCase;

class TagsSearchControllerTest extends TestCase
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
        $response = $this->post(route('visitor.tag.search', ['keyword' => 'ほげほげ']));
        $response->assertStatus(302);
    }
}
