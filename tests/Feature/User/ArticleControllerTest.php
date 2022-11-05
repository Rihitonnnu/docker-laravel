<?php

namespace Tests\Feature;

use App\Models\Article;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ArticleControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->count(2)
            ->state(new Sequence(
                ['id' => 1],//自分
                ['id' => 2],//他のユーザー
            ))->create();
    }

    /**
     * @test
     */
    public function ログインしていれば自分の投稿一覧を表示する()
    {
        $this->actingAs($this->user[0], 'users');

        Article::factory()->count(2)
            ->state(new Sequence(
                ['user_id' => 1],//自分の記事
                ['user_id' => 2],//他の人の記事
            ))->create();

        $response = $this->get(route('user.article.index'));

        $getArticle = Article::where('user_id', $this->user[0]->id)->get();

        $this->assertNotEquals(2, $getArticle[0]->user_id);//自分の記事以外が含まれていないかの確認

        $response->assertStatus(200);
        $response->assertViewIs('user.article.index');
    }
}
