<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_redirects_to_dashboard_page_if_logged_in_user_trying_to_visit_login_page()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('login'))
            ->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function a_user_can_visit_dashboard_page()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertViewIs('dashboard');
    }

    /** @test */
    public function guest_can_not_visit_dashboard_page()
    {
        $this->get(route('dashboard'))
            ->assertRedirect(route('login'));
    }
}
