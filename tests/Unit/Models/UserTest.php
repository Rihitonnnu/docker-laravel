<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'name' => 'test',
            'email' => 'test@example.com'
        ]);
    }

    public function test_updateUser()
    {
        $updatedUser = (new User())->updateUser('hoge', 'hoge@example.com', $this->user->id);

        $this->assertEquals('hoge', $updatedUser->name);
        $this->assertEquals('hoge@example.com', $updatedUser->email);
    }

    /**
     * @test
     */
    public function test_deleteUser()
    {
        $this->user->delete($this->user);

        $this->assertModelMissing($this->user);
    }
}
