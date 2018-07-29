<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InfoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_authenticated_user_can_see_info()
    {
        $this->get(route('info'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_see_info()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->get(route('info'))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function authenticated_user_can_see_info()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('info'))
            ->assertViewIs('info');
    }
}
