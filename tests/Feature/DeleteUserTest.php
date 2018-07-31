<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_delete_a_user()
    {
        $userToDelete = factory(User::class)->create();

        $this->delete(route('users.destroy', $userToDelete))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_delete_a_user()
    {
        $user = factory(User::class)->states('unacceptable')->create();
        $userToDelete = factory(User::class)->create();

        $this->actingAs($user)
            ->delete(route('users.destroy', $userToDelete))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function employee_can_not_delete_a_user()
    {
        $userToDelete = factory(User::class)->create();
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->delete(route('users.destroy', $userToDelete))
            ->assertStatus(403);
    }

    /** @test */
    public function admin_can_delete_a_user()
    {
        $userToDelete = factory(User::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->delete(route('users.destroy', $userToDelete))
            ->assertSessionHas('status', 'The beetroot was successfully deleted!');
    }
}
