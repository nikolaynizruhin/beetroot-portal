<?php

namespace Tests\Feature\Tag;

use App\Tag;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_visit_create_tag_page()
    {
        $this->get(route('tags.create'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_can_not_visit_create_tag_page()
    {
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->get(route('tags.create'))
            ->assertForbidden();
    }

    /** @test */
    public function admin_can_visit_create_tag_page()
    {
        $user = factory(User::class)->states('admin')->create();

        $this->actingAs($user)
            ->get(route('tags.create'))
            ->assertSuccessful()
            ->assertViewIs('tags.create');
    }

    /** @test */
    public function guest_can_not_create_a_tag()
    {
        $this->post(route('tags.store'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_create_a_tag()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->post(route('tags.store'))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function employee_can_not_create_a_tag()
    {
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->post(route('tags.store'))
            ->assertForbidden();
    }

    /** @test */
    public function tag_name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->post(route('tags.store'), ['name' => null])
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function tag_name_should_be_unique()
    {
        $admin = factory(User::class)->states('admin')->create();
        $tag = factory(Tag::class)->create();

        $this->actingAs($admin)
            ->from(route('tags.create'))
            ->post(route('tags.store'), ['name' => $tag->name])
            ->assertRedirect(route('tags.create'))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function admin_can_create_a_tag()
    {
        $admin = factory(User::class)->states('admin')->create();
        $tag = factory(Tag::class)->make()->toArray();

        $this->actingAs($admin)
            ->post(route('tags.store'), $tag)
            ->assertSessionHas('status', 'The technology was successfully created!');

        $this->assertDatabaseHas('tags', $tag);
    }
}
