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
    public function employee_can_not_delete_a_user()
    {
        $userToDelete = factory(User::class)->create();
        $user = factory(User::class)->create(['is_admin' => false]);

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
            ->assertSessionHas('status', 'The employee was successfully deleted!');
    }
}
