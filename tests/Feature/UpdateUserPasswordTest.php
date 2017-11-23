<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateUserPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Only user can update own password.
     *
     * @return void
     */
    public function testOnlyUserCanUpdateOwnPassword()
    {
        $owner = factory(User::class)->create();
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->put(route('users.password.update', $owner->id))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->put(route('users.password.update', $owner->id))
            ->assertStatus(403);
    }

    /**
     * Admin can update user password.
     *
     * @return void
     */
    public function testAdminCanUpdateUserPassword()
    {
        $owner = factory(User::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $attributes = [
            'password' => 'secret-updated',
            'password_confirmation' => 'secret-updated',
        ];

        $this->actingAs($admin)
            ->put(route('users.password.update', $owner->id), $attributes)
            ->assertSessionHas('status', 'The employee password was successfully updated!');

        $owner = $owner->fresh();

        $this->assertTrue(Hash::check('secret-updated', $owner->password));
    }

    /**
     * User can update own password.
     *
     * @return void
     */
    public function testUserCanUpdateOwnPassword()
    {
        $owner = factory(User::class)->create(['is_admin' => false]);

        $attributes = [
            'password' => 'secret-updated',
            'password_confirmation' => 'secret-updated',
        ];

        $this->actingAs($owner)
            ->put(route('users.password.update', $owner->id), $attributes)
            ->assertSessionHas('status', 'The employee password was successfully updated!');

        $owner = $owner->fresh();

        $this->assertTrue(Hash::check('secret-updated', $owner->password));
    }

    /**
     * User password fields are required.
     *
     * @return void
     */
    public function testUserPasswordFieldsAreRequired()
    {
        $owner = factory(User::class)->create();

        $this->actingAs($owner)
            ->put(route('users.password.update', $owner->id))
            ->assertSessionHasErrors(['password']);
    }
}
