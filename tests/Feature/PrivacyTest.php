<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PrivacyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_authenticated_user_can_see_privacy()
    {
        $this->get(route('privacy'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_user_can_see_privacy()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('privacy'))
            ->assertViewIs('privacy');
    }
}
