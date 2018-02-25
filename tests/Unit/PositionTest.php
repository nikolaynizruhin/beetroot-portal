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

        $this->assertEquals(count($positions), 49);
        $this->assertEquals($positions[0], 'Python Developer');
    }

    /** @test */
    public function it_can_get_a_csv_of_positions()
    {
        $positions = Position::csv();

        $this->assertEquals(strpos($positions, 'Python Developer'), 0);
    }
}
