<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_see_welcome_page()
    {
        $this->get(route('welcome'))
            ->assertViewIs('welcome');
    }

    /** @test */
    public function it_should_redirect_to_dashboard_if_user_logged_in()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('welcome'))
            ->assertRedirect(route('dashboard'));
    }
}
