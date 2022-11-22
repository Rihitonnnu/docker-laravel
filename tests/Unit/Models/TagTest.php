<?php

namespace Tests\Unit\Models;

use App\Models\Tag;
use Tests\TestCase;

class TagTest extends TestCase
{
    public function test_storeTag()
    {
        $tag = (new Tag())->storeTag('ほげほげ');

        $this->assertEquals('ほげほげ', $tag->name);
    }
}
