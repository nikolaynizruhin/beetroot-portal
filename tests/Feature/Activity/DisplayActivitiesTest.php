<?php

namespace Tests\Feature\Activity;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayActivitiesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_see_a_activities()
    {
        $this->get(route('activities.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_see_activities()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->get(route('activities.index'))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function logged_in_employee_can_see_a_activities()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('activities.index'))
            ->assertSuccessful()
            ->assertViewIs('activities.index');
    }
}
