<?php

namespace Tests\Unit;

use App\Activity;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_check_whatever_activity_is_anniversary()
    {
        $user = factory(User::class)->create(['created_at' => now()]);

        $user->recordActivity(Activity::ANNIVERSARY);

        $this->assertTrue($user->activities->last()->isAnniversary());
    }

    /** @test */
    public function it_can_get_activity_anniversary()
    {
        $user = factory(User::class)->create(['created_at' => now()->subYear()]);

        $user->recordActivity(Activity::ANNIVERSARY);

        $this->assertEquals(1, $user->activities->last()->anniversary());
    }

    /** @test */
    public function it_should_return_null_if_user_has_no_anniversary()
    {
        $user = factory(User::class)->create(['created_at' => now()->subDay()]);

        $user->recordActivity(Activity::ANNIVERSARY);

        $this->assertNull($user->activities->last()->anniversary());
    }
}
