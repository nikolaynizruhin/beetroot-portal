<?php

namespace Tests\Unit\Utilities;

use Tests\TestCase;
use App\Http\Utilities\Position;

class PositionTest extends TestCase
{
    /** @test */
    public function it_can_get_all_positions()
    {
        $positions = Position::all();

        $this->assertCount(48, $positions);
        $this->assertEquals($positions[0], 'Administration');
    }
}
