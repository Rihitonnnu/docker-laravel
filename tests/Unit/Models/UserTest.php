<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_updateUser()
    {
        $user = User::factory()->create([
            'name' => 'test',
            'email' => 'test@example.com'
        ]);

        $updatedUser = (new User())->updateUser('hoge', 'hoge@example.com', $user->id);

        $this->assertEquals('hoge', $updatedUser->name);
        $this->assertEquals('hoge@example.com', $updatedUser->email);
    }
}
