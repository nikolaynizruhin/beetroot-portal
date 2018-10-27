<?php

namespace Tests\Feature\Tag;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayTagsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_see_a_tags()
    {
        $this->get(route('tags.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_see_tags()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->get(route('tags.index'))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function employee_can_visit_tags_page()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('tags.index'))
            ->assertSuccessful()
            ->assertViewIs('tags.index');
    }
}
