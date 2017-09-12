<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
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
            ->assertRedirect('home');
    }

    /**
     * User can view home page.
     *
     * @return void
     */
    public function testUserCanViewHomePage()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('home'))
            ->assertSee('Home')
            ->assertSee($user->name);
    }
}
