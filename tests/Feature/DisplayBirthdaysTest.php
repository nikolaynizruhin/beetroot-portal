<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayBirthdaysTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_see_a_birthdays()
    {
        $this->get(route('birthdays.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function logged_in_employee_can_see_a_birthdays()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('birthdays.index'))
            ->assertSuccessful()
            ->assertViewIs('birthdays.index');
    }
}
