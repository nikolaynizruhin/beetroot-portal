<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use App\Queries\OfficeUsersCountQuery;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OfficeUsersCountQueryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_office_user_count()
    {
        $user = factory(User::class)->create();

        $collection = resolve(OfficeUsersCountQuery::class)();

        $this->assertEquals($collection->first()->city, $user->office->city);
        $this->assertEquals($collection->first()->users_count, 1);
    }
}
