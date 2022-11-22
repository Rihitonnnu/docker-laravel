<?php

namespace Tests\Unit\Models;

use App\Models\Tag;
use Tests\TestCase;

class TagTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->tag = Tag::factory()->create([
            'name' => 'ほげほげ',
        ]);
    }

    public function test_storeTag()
    {
        $tag = (new Tag())->storeTag('ほげほげ');

        $this->assertEquals('ほげほげ', $tag->name);
    }

    public function test_updateTag()
    {
        $updateTag = (new Tag())->updateTag('ふがふが', $this->tag->id);

        $this->assertEquals('ふがふが', $updateTag->name);
    }

    public function test_destroyTag()
    {
        (new Tag())->destroyTag($this->tag->id);

        $this->assertSoftDeleted($this->tag);
    }
}
