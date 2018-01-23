<?php

namespace Tests\Feature;

use App\User;
use App\Office;
use App\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserFiltersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_filter_employees_by_name()
    {
        $john = factory(User::class)->create(['name' => 'John Doe']);
        $jane = factory(User::class)->create(['name' => 'Jane Doe']);

        $this->actingAs($john)
            ->get(route('users.index', ['name' => $john->name]))
            ->assertSee($john->name)
            ->assertDontSee($jane->name);
    }

    /** @test */
    public function a_user_can_filter_employees_by_position()
    {
        $john = factory(User::class)->create([
            'name' => 'John Doe',
            'position' => 'CEO'
        ]);

        $jane = factory(User::class)->create([
            'name' => 'Jane Doe',
            'position' => 'CMO'
        ]);

        $this->actingAs($john)
            ->get(route('users.index', ['position' => $john->position]))
            ->assertSee($john->name)
            ->assertDontSee($jane->name);
    }

    /** @test */
    public function a_user_can_filter_employees_by_office()
    {
        $london = factory(Office::class)->create(['city' => 'London']);
        $ny = factory(Office::class)->create(['city' => 'NY']);

        $john = factory(User::class)->create([
            'name' => 'John Doe',
            'office_id' => $london->id
        ]);

        $jane = factory(User::class)->create([
            'name' => 'Jane Doe',
            'office_id' => $ny->id
        ]);

        $this->actingAs($john)
            ->get(route('users.index', ['office' => $london->city]))
            ->assertSee($john->name)
            ->assertDontSee($jane->name);
    }

    /** @test */
    public function a_user_can_filter_employees_by_client()
    {
        $alliance = factory(Client::class)->create(['name' => 'Alliance']);
        $brothers = factory(Client::class)->create(['name' => 'Brothers']);

        $john = factory(User::class)->create([
            'name' => 'John Doe',
            'client_id' => $alliance->id
        ]);

        $jane = factory(User::class)->create([
            'name' => 'Jane Doe',
            'client_id' => $brothers->id
        ]);

        $this->actingAs($john)
            ->get(route('users.index', ['client' => $alliance->name]))
            ->assertSee($john->name)
            ->assertDontSee($jane->name);
    }
}
