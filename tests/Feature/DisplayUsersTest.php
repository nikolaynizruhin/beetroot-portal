<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_see_an_employees()
    {
        $this->get(route('users.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function logged_in_employee_can_see_an_employees()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('users.index'))
            ->assertSuccessful()
            ->assertViewIs('users.index');
    }
}
