<?php

namespace Tests\Feature\Activity;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_delete_an_activity()
    {
        $user = factory(User::class)->create();

        $this->delete(route('activities.destroy', $user->activities->last()))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_delete_an_activity()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->delete(route('activities.destroy', $user->activities->last()))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function employee_can_not_delete_an_activity()
    {
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->delete(route('activities.destroy', $user->activities->last()))
            ->assertStatus(403);
    }

    /** @test */
    public function admin_can_delete_an_activity()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->delete(route('activities.destroy', $admin->activities->last()))
            ->assertRedirect(route('activities.index'));

        $this->assertDatabaseMissing('activities', $admin->activities->last()->toArray());
    }
}
