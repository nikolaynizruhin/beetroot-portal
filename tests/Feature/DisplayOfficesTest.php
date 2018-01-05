<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayOfficesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_see_an_offices()
    {
        $this->get(route('offices.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function logged_in_employee_can_see_an_offices()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('offices.index'))
            ->assertSee('Offices')
            ->assertStatus(200);
    }
}
