<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcceptPrivacyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function employee_can_see_accept_privacy_policy_page()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->get(route('accept.create'))
            ->assertViewIs('accept.create');
    }

    /** @test */
    public function it_redirects_from_accept_page_if_user_already_accept_privacy()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('accept.create'))
            ->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function it_redirects_from_store_accept_page_if_user_already_accept_privacy()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post(route('accept.store'))
            ->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function employee_can_accept_privacy_policy()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->post(route('accept.store'), [
                'privacy' => 'on',
            ])
            ->assertRedirect(route('dashboard'));

        $this->assertNotNull($user->accepted_at);
    }

    /** @test */
    public function accept_privacy_policy_is_required()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->post(route('accept.store'))
            ->assertSessionHasErrors('privacy');
    }
}
