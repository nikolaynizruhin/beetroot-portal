<?php

namespace Tests\Feature;

use App\User;
use App\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientFiltersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_filter_clients_by_name()
    {
        $user = factory(User::class)->create();

        $alliance = factory(Client::class)->create(['name' => 'Alliance']);
        $brothers = factory(Client::class)->create(['name' => 'Brothers']);

        $this->actingAs($user)
            ->get(route('clients.index', ['name' => $alliance->name]))
            ->assertSee($alliance->name)
            ->assertDontSee($brothers->name);
    }

    /** @test */
    public function a_user_can_filter_clients_by_country()
    {
        $user = factory(User::class)->create();

        $alliance = factory(Client::class)->create([
            'name' => 'Alliance',
            'country' => 'USA',
        ]);

        $brothers = factory(Client::class)->create([
            'name' => 'Brothers',
            'country' => 'UK',
        ]);

        $this->actingAs($user)
            ->get(route('clients.index', ['country' => $alliance->country]))
            ->assertSee($alliance->name)
            ->assertDontSee($brothers->name);
    }
}
