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
        $clients = factory(Client::class, 3)->create();

        $firstClient = $clients->first();
        $lastClient = $clients->last();

        $this->actingAs($user)
            ->get(route('clients.index'))
            ->assertSee('Clients')
            ->assertSee($firstClient->name)
            ->assertSee($lastClient->name);
    }
}
