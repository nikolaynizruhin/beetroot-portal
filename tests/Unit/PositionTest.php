<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Utilities\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PositionTest extends TestCase
{
    /** @test */
    public function it_can_get_all_positions()
    {
        $positions = Position::all();

        $this->assertEquals(count($positions), 29);
        $this->assertEquals($positions[0], 'Python Developer');
    }

    /** @test */
    public function it_can_get_a_csv_of_positions()
    {
        $positions = Position::csv();

        $this->assertEquals(strpos($positions, 'Python Developer'), 0);
    }

    /** @test */
    public function it_can_get_a_random_position()
    {
        $position = Position::rand();

        $this->assertTrue(in_array($position, Position::all()));
    }
}
