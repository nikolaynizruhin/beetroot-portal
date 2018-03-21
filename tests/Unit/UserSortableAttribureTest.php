<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Utilities\UserSortableAttribute;

class UserSortableAttributeTest extends TestCase
{
    /** @test */
    public function it_can_get_all_user_sortable_attribures()
    {
        $attributes = UserSortableAttribute::all();

        $this->assertEquals(count($attributes), 3);
        $this->assertEquals($attributes['name,asc'], 'Name');
    }
}
