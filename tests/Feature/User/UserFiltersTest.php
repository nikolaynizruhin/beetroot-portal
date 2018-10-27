<?php

namespace Tests\Feature\User;

use App\User;
use App\Client;
use App\Office;
use Tests\TestCase;
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
            'position' => 'CEO',
        ]);

        $jane = factory(User::class)->create([
            'name' => 'Jane Doe',
            'position' => 'CMO',
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
            'office_id' => $london->id,
        ]);

        $jane = factory(User::class)->create([
            'name' => 'Jane Doe',
            'office_id' => $ny->id,
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
            'client_id' => $alliance->id,
        ]);

        $jane = factory(User::class)->create([
            'name' => 'Jane Doe',
            'client_id' => $brothers->id,
        ]);

        $this->actingAs($john)
            ->get(route('users.index', ['client' => $alliance->name]))
            ->assertSee($john->name)
            ->assertDontSee($jane->name);
    }

    /** @test */
    public function a_user_can_sort_employees_by_newcomers()
    {
        $john = factory(User::class)->create([
            'name' => 'John Doe',
            'created_at' => '2018-01-01',
        ]);
        $jane = factory(User::class)->create([
            'name' => 'Jane Doe',
            'created_at' => '2018-01-02',
        ]);

        $this->actingAs($john)
            ->get(route('users.index', ['sort' => '-created_at']))
            ->assertSeeInOrder([$jane->name, $john->name]);
    }

    /** @test */
    public function a_user_can_sort_employees_by_elders()
    {
        $john = factory(User::class)->create([
            'name' => 'John Doe',
            'created_at' => '2018-01-01',
        ]);
        $jane = factory(User::class)->create([
            'name' => 'Jane Doe',
            'created_at' => '2018-01-02',
        ]);

        $this->actingAs($john)
            ->get(route('users.index', ['sort' => 'created_at']))
            ->assertSeeInOrder([$john->name, $jane->name]);
    }

    /** @test */
    public function a_user_can_view_employees_with_default_sort()
    {
        $john = factory(User::class)->create(['name' => 'John Doe']);
        $jane = factory(User::class)->create(['name' => 'Jane Doe']);

        $this->actingAs($john)
            ->get(route('users.index'))
            ->assertSeeInOrder([$jane->name, $john->name]);
    }

    /** @test */
    public function guest_can_not_filter_users()
    {
        $this->get(route('users.index', ['office' => 'London']))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_filter_users()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->get(route('users.index', ['office' => 'London']))
            ->assertRedirect(route('accept.create'));
    }
}
