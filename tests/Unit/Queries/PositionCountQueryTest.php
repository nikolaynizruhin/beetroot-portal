<?php

namespace Tests\Unit\Queries;

use App\User;
use Tests\TestCase;
use App\Queries\PositionCountQuery;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PositionCountQueryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_position_count()
    {
        $user = factory(User::class)->create();

        $collection = app(PositionCountQuery::class)();

        $this->assertEquals($collection->first()->title, $user->position);
        $this->assertEquals($collection->first()->count, 1);
    }
}
