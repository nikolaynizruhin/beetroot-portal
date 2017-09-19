<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use App\Queries\PositionCountQuery;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PositionCountQueryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Position count query.
     *
     * @return void
     */
    public function testPositionCountQuery()
    {
        $user = factory(User::class)->create();

        $collection = resolve(PositionCountQuery::class)();

        $this->assertEquals($collection->first()->title, $user->position);
        $this->assertEquals($collection->first()->count, 1);
    }
}
