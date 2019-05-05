<?php

namespace Tests\Console;

use App\Activity;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClearActivitiesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_remove_activities_older_than_three_months()
    {
        $user = factory(User::class)->create();

        $user->activities()->create([
            'name' => Activity::ANNIVERSARY,
            'created_at' => now()->subMonths(4),
        ]);

        $this->artisan('activity:clear')
            ->expectsOutput('(1) Activities older than 3 months was removed successfully!')
            ->assertExitCode(0);

        $this->assertCount(1, $user->activities);
        $this->assertNotEquals(Activity::ANNIVERSARY, $user->activities->last()->name);
    }

    /** @test */
    public function it_should_remove_activities_older_than_amount_of_months_you_set()
    {
        $user = factory(User::class)->create();

        $user->activities()->create([
            'name' => Activity::ANNIVERSARY,
            'created_at' => now()->subMonths(2),
        ]);

        $this->artisan('activity:clear', ['months' => 1])
            ->expectsOutput('(1) Activities older than 1 months was removed successfully!')
            ->assertExitCode(0);

        $this->assertCount(1, $user->activities);
        $this->assertNotEquals(Activity::ANNIVERSARY, $user->activities->last()->name);
    }
}