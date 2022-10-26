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
    public function データベースが更新されているかの確認()
    {
        //更新テスト用データで更新が正常に行われているか確認
        $this->assertDatabaseHas('users', [
            'name' => 'test',
            'email' => 'test@gmail.com',
        ]);
    }
}
