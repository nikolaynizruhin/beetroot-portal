<?php

namespace Tests\Feature\Birthday;

use App\User;
use App\Office;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BirthdayFiltersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_filter_birthdays_by_office()
    {
        $london = factory(Office::class)->create(['city' => 'London']);
        $paris = factory(Office::class)->create(['city' => 'Paris']);

        $john = factory(User::class)->create([
            'name' => 'John Doe',
            'office_id' => $london->id,
        ]);

        $jane = factory(User::class)->create([
            'name' => 'Jane Doe',
            'office_id' => $paris->id,
        ]);

        $this->actingAs($john)
            ->get(route('birthdays.index', ['office' => $london->city]))
            ->assertSee($john->name)
            ->assertDontSee($jane->name);
    }

    /** @test */
    public function it_sorts_birthdays_by_month_and_day()
    {
        $john = factory(User::class)->create([
            'name' => 'John Doe',
            'birthday' => '2015-12-01',
        ]);

        $jane = factory(User::class)->create([
            'name' => 'Jane Doe',
            'birthday' => '2015-01-12',
        ]);

        $this->actingAs($john)
            ->get(route('birthdays.index'))
            ->assertSeeInOrder([$jane->name, $john->name]);
    }

    /** @test */
    public function guest_can_not_filter_birthdays_by_office()
    {
        $this->get(route('birthdays.index', ['office' => 'London']))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_filter_birthdays_by_office()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->get(route('birthdays.index', ['office' => 'London']))
            ->assertRedirect(route('accept.create'));
    }
}
