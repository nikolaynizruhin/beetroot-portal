<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayClientsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_see_a_clients()
    {
        $this->get(route('clients.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_see_clients()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->get(route('clients.index'))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function logged_in_employee_can_see_a_clients()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('clients.index'))
            ->assertSuccessful()
            ->assertViewIs('clients.index');
    }
}
