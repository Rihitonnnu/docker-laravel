<?php

namespace Tests\Feature\Admin\User;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function モデルの存在確認()
    {
        $user = User::factory()->create();
        $this->assertModelExists($user);
    }

    /**
     * @test
     */
    public function ユーザー情報の更新処理()
    {
        $this->assertDatabaseHas('users', [
            'name' => 'test',
            'email' => 'user@example.com',
        ]);
    }
}
