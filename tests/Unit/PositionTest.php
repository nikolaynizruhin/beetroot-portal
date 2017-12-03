<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Utilities\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PositionTest extends TestCase
{
    /**
     * Get all positions.
     *
     * @return void
     */
    public function testGetAllPositions()
    {
        $positions = Position::all();

        $this->assertEquals(count($positions), 29);
        $this->assertEquals($positions[0], 'Python Developer');
    }

    /**
     * Get csv positions.
     *
     * @return void
     */
    public function testGetCsvPositions()
    {
        $positions = Position::csv();

        $this->assertEquals(strpos($positions, 'Python Developer'), 0);
    }

    /**
     * Get random position.
     *
     * @return void
     */
    public function testGetRandomPosition()
    {
        $position = Position::rand();

        $this->assertTrue(in_array($position, Position::all()));
    }
}
