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
        $createdUser = User::factory()->create();

        //更新テスト用のデータ
        $updateData = [
            'name' => 'test',
            'email' => 'user@example.com',
        ];

        $updatedUser = new User();
        $updatedUser->updateUser($updateData['name'], $updateData['email'], $createdUser->id);

        $this->assertDatabaseHas('users', [
            'name' => 'test',
            'email' => 'user@example.com',
        ]);
    }
}
