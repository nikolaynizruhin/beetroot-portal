<?php

namespace Tests\Feature;

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
            ->get(route('birthdays.index', ['office' => $london->city]))
            ->assertSee($john->name)
            ->assertDontSee($jane->name);
    }
}
