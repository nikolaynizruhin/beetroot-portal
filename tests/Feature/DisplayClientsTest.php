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
    public function logged_in_employee_can_see_a_clients()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('clients.index'))
            ->assertSee('Clients')
            ->assertStatus(200);
    }
}
