<?php

namespace Tests\Feature;

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
    public function ログインしていれば自分の投稿一覧を表示する()
    {
        $this->actingAs($this->user, 'users');

        $response = $this->get(route('user.article.index'));
        $response->assertStatus(200);
        $response->assertViewIs('user.article.index');
    }
}
