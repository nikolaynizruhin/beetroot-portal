<?php

namespace Tests\Unit\Queries;

use App\User;
use Tests\TestCase;
use App\Queries\UserCountPerYearQuery;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCountPerYearQueryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_user_count_per_year()
    {
        $user = factory(User::class)->create();

        $collection = resolve(UserCountPerYearQuery::class)();

        $this->assertEquals($collection->all(), [
            $user->year_of_created => 1,
        ]);
    }
}
