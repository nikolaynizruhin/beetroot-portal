<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GalleryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_authenticated_user_can_see_gallery()
    {
        $this->get(route('gallery'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_see_gallery()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->get(route('gallery'))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function authenticated_user_can_see_gallery()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('gallery'))
            ->assertViewIs('gallery');
    }
}
