<?php

namespace Tests\Feature\Tag;

use App\Tag;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_delete_a_tag()
    {
        $tag = factory(Tag::class)->create();

        $this->delete(route('tags.destroy', $tag))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_delete_a_tag()
    {
        $user = factory(User::class)->states('unacceptable')->create();
        $tag = factory(Tag::class)->create();

        $this->actingAs($user)
            ->delete(route('tags.destroy', $tag))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function employee_can_not_delete_a_tag()
    {
        $tag = factory(Tag::class)->create();
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->delete(route('tags.destroy', $tag))
            ->assertStatus(403);
    }

    /** @test */
    public function admin_can_delete_a_tag()
    {
        $tag = factory(Tag::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->delete(route('tags.destroy', $tag))
            ->assertSessionHas('status', 'The technology was successfully deleted!');

        $this->assertDatabaseMissing('users', $tag->toArray());
    }
}
