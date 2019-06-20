<?php

namespace Tests\Feature\Tag;

use App\Tag;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_visit_update_tag_page()
    {
        $tag = factory(Tag::class)->create();

        $this->get(route('tags.edit', $tag))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_can_not_visit_update_tag_page()
    {
        $user = factory(User::class)->states('employee')->create();
        $tag = factory(Tag::class)->create();

        $this->actingAs($user)
            ->get(route('tags.edit', $tag))
            ->assertForbidden();
    }

    /** @test */
    public function admin_can_visit_update_tag_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $tag = factory(Tag::class)->create();

        $this->actingAs($admin)
            ->get(route('tags.edit', $tag))
            ->assertSuccessful()
            ->assertViewIs('tags.edit');
    }

    /** @test */
    public function guest_can_not_update_a_tag()
    {
        $tag = factory(Tag::class)->create();

        $this->put(route('tags.update', $tag))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_update_a_tag()
    {
        $user = factory(User::class)->states('unacceptable')->create();
        $tag = factory(Tag::class)->create();

        $this->actingAs($user)
            ->put(route('tags.update', $tag))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function employee_can_not_update_a_tag()
    {
        $tag = factory(Tag::class)->create();
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->put(route('tags.update', $tag))
            ->assertForbidden();
    }

    /** @test */
    public function tag_name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $tag = factory(Tag::class)->create();

        $this->actingAs($admin)
            ->from(route('tags.edit', $admin))
            ->put(route('tags.update', $tag), ['name' => null])
            ->assertRedirect(route('tags.edit', $admin))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function tag_name_should_be_unique_except_itself()
    {
        $admin = factory(User::class)->states('admin')->create();
        $tag = factory(Tag::class)->create();

        $this->actingAs($admin)
            ->put(route('tags.update', $tag), $tag->toArray())
            ->assertSessionHas('status', 'The technology was successfully updated!');
    }

    /** @test */
    public function admin_can_update_a_tag()
    {
        $tag = factory(Tag::class)->create();
        $updatedTag = factory(Tag::class)->make()->toArray();
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->put(route('tags.update', $tag), $updatedTag)
            ->assertSessionHas('status', 'The technology was successfully updated!');

        $this->assertDatabaseHas('tags', $updatedTag);
    }
}
