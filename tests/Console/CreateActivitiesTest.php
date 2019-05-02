<?php

namespace Tests\Console;

use App\User;
use App\Activity;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateActivitiesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_create_activity_on_user_birthday()
    {
        $user = factory(User::class)->create(['birthday' => today()]);

        $this->artisan('activity:create')
            ->expectsOutput('1 - Birthdays')
            ->assertExitCode(0);

        $this->assertCount(2, $user->activities);
        $this->assertEquals(Activity::BIRTHDAY, $user->activities->last()->name);
    }

    /** @test */
    public function it_should_create_activity_on_user_anniversary()
    {
        $user = factory(User::class)->create(['created_at' => today()->subYear()]);

        $this->artisan('activity:create')
            ->expectsOutput('1 - Anniversaries')
            ->assertExitCode(0);

        $this->assertCount(2, $user->activities);
        $this->assertEquals(Activity::ANNIVERSARY, $user->activities->last()->name);
    }
}
