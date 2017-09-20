<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Redirect if logged in.
     *
     * @return void
     */
    public function testRedirectIfLoggedIn()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('login'))
            ->assertRedirect('dashboard');
    }

    /**
     * User can view dashboard page.
     *
     * @return void
     */
    public function testUserCanViewDashboardPage()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertSee('Dashboard')
            ->assertSee('POSITIONS')
            ->assertSee('CLIENTS');
    }
}
