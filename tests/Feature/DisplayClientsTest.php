<?php

namespace Tests\Feature;

use App\User;
use App\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayClientsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Guest can not see clients.
     *
     * @return void
     */
    public function testGuestCanNotSeeClients()
    {
        $this->get(route('clients.index'))
            ->assertRedirect(route('login'));
    }

    /**
     * User can see clients.
     *
     * @return void
     */
    public function testUserCanSeeClients()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('clients.index'))
            ->assertSee('Clients')
            ->assertStatus(200);
    }
}
