<?php

namespace Tests\Feature;

use App\User;
use App\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteClientTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Only admin can delete a client.
     *
     * @return void
     */
    public function testOnlyAdminCanDeleteAUser()
    {
        $client = factory(Client::class)->create();
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->delete(route('clients.destroy', $client->id))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->delete(route('clients.destroy', $client->id))
            ->assertStatus(403);
    }

    /**
     * Admin can delete a client.
     *
     * @return void
     */
    public function testAdminCanDeleteAClient()
    {
        $client = factory(Client::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->delete(route('clients.destroy', $client->id))
            ->assertSessionHas('status', 'The client was successfully deleted!');
    }
}
