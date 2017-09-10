<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteUser extends TestCase
{
    /**
     * Only admin can delete a user.
     *
     * @return void
     */
    public function testOnlyAdminCanDeleteAUser()
    {
        $userToDelete = factory(User::class)->create();
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->delete(route('users.destroy', $userToDelete->id))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->delete(route('users.destroy', $userToDelete->id))
            ->assertStatus(403);
    }

    /**
     * Admin can delete a user.
     *
     * @return void
     */
    public function testAdminCanDeleteAUser()
    {
        $userToDelete = factory(User::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this->delete(route('users.destroy', $userToDelete->id))
            ->assertSessionHas('status', 'The user was successfully deleted!');
    }
}
