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

        /** @test */
    public function guest_can_not_filter_clients()
    {
        $this->get(route('clients.index', ['country' => 'USA']))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_filter_clients()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->get(route('clients.index', ['country' => 'USA']))
            ->assertRedirect(route('accept.create'));
    }
}
