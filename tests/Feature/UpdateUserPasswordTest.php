<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateUserPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_update_employee_password()
    {
        $owner = factory(User::class)->create();

        $this->put(route('users.password.update', $owner))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_update_password()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->put(route('users.update', $user))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function employee_can_not_update_another_employee_password()
    {
        $owner = factory(User::class)->create();
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->put(route('users.password.update', $owner))
            ->assertStatus(403);
    }

    /** @test */
    public function admin_can_update_any_employees_password()
    {
        $owner = factory(User::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $attributes = [
            'password' => 'secret-updated',
            'password_confirmation' => 'secret-updated',
        ];

        $this->actingAs($admin)
            ->put(route('users.password.update', $owner), $attributes)
            ->assertSessionHas('status', 'The employee password was successfully updated!');

        $owner = $owner->fresh();

        $this->assertTrue(Hash::check('secret-updated', $owner->password));
    }

    /** @test */
    public function employee_can_update_own_password()
    {
        $owner = factory(User::class)->states('employee')->create();

        $attributes = [
            'password' => 'secret-updated',
            'password_confirmation' => 'secret-updated',
        ];

        $this->actingAs($owner)
            ->put(route('users.password.update', $owner), $attributes)
            ->assertSessionHas('status', 'The employee password was successfully updated!');

        $owner = $owner->fresh();

        $this->assertTrue(Hash::check('secret-updated', $owner->password));
    }

    /** @test */
    public function password_fields_are_required()
    {
        $owner = factory(User::class)->create();

        $this->actingAs($owner)
            ->put(route('users.password.update', $owner))
            ->assertSessionHasErrors('password');
    }
}
