<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

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

        $this->actingAs($admin)
            ->delete(route('users.destroy', $userToDelete->id))
            ->assertSessionHas('status', 'The employee was successfully deleted!');
    }
}
