<?php

namespace Tests\Feature;

use App\User;
use App\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteClientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_delete_a_client()
    {
        $client = factory(Client::class)->create();

        $this->delete(route('clients.destroy', $client))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_can_not_delete_a_client()
    {
        $client = factory(Client::class)->create();
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($user)
            ->delete(route('clients.destroy', $client))
            ->assertStatus(403);
    }

    /** @test */
    public function admin_can_delete_a_client()
    {
        $client = factory(Client::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->delete(route('clients.destroy', $client))
            ->assertSessionHas('status', 'The client was successfully deleted!');
    }
}
