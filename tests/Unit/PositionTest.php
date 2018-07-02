<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Utilities\Position;

class PositionTest extends TestCase
{
    /** @test */
    public function it_can_get_all_positions()
    {
        $positions = Position::all();

        $this->assertEquals(count($positions), 47);
        $this->assertEquals($positions[0], 'Account Manager');
    }
}
