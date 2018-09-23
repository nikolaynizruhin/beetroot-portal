<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_update_employee()
    {
        $owner = factory(User::class)->states('employee')->create();

        $this->put(route('users.update', $owner))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_can_not_update_employee_profile()
    {
        $owner = factory(User::class)->states('employee')->create();

        $this->put(route('profile.update', $owner))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_update_user()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->put(route('users.update', $user))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function employee_can_not_update_another_employee()
    {
        $owner = factory(User::class)->states('employee')->create();
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->put(route('users.update', $owner))
            ->assertStatus(403);
    }

    /** @test */
    public function employee_can_not_update_another_employee_profile()
    {
        $owner = factory(User::class)->states('employee')->create();
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->put(route('profile.update', $owner))
            ->assertStatus(403);
    }

    /** @test */
    public function employee_can_not_update_own_protected_fields()
    {
        $owner = factory(User::class)->states('employee')->create();

        $this->actingAs($owner)
            ->put(route('users.update', $owner))
            ->assertStatus(403);
    }

    /** @test */
    public function guest_can_not_visit_employee_settings_page()
    {
        $userToEdit = factory(User::class)->states('employee')->create();

        $this->get(route('users.edit', $userToEdit))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_can_not_visit_another_employee_settings_page()
    {
        $user = factory(User::class)->states('employee')->create();
        $userToEdit = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->get(route('users.edit', $userToEdit))
            ->assertStatus(403);
    }

    /** @test */
    public function employee_can_visit_own_settings_page()
    {
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->get(route('users.edit', $user))
            ->assertSuccessful()
            ->assertViewIs('users.edit')
            ->assertDontSee('Delete Account');
    }

    /** @test */
    public function admin_can_visit_any_employee_settings_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $userToEdit = factory(User::class)->states('employee')->create();

        $this->actingAs($admin)
            ->get(route('users.edit', $userToEdit))
            ->assertSuccessful()
            ->assertViewIs('users.edit');
    }

    /** @test */
    public function admin_can_update_any_employee_profile()
    {
        $owner = factory(User::class)->create();
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->states('admin')->make()
            ->makeHidden(['avatar', 'accepted_at'])
            ->toArray();

        $file = UploadedFile::fake()->image('avatar.jpg');

        Storage::fake('public');
        Image::shouldReceive('make->fit->save')->once();

        $this->actingAs($admin)
            ->put(route('users.update', $owner), $this->input($user, $file))
            ->assertSessionHas('status', 'The beetroot was successfully updated!');

        $this->assertDatabaseHas('users', $this->resultForAdmin($user, $file));

        Storage::disk('public')->assertExists('avatars/'.$file->hashName());
    }

    /** @test */
    public function employee_can_update_own_profile()
    {
        $owner = factory(User::class)->states('employee')->create();
        $user = factory(User::class)->states('admin')->make()
            ->makeHidden(['avatar', 'accepted_at'])
            ->toArray();

        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->actingAs($owner)
            ->put(route('profile.update', $owner), $this->input($user, $file))
            ->assertSessionHas('status', 'The beetroot was successfully updated!');

        $this->assertDatabaseHas('users', $this->resultForEmployee($user));
    }

    /** @test */
    public function some_of_employee_fields_are_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->put(route('users.update', $admin))
            ->assertSessionHasErrors([
                'name',
                'gender',
                'email',
                'position',
                'birthday',
                'created_at',
                'client_id',
                'office_id',
            ]);
    }

    /**
     * Get input attributes for admin.
     *
     * @param  array  $user
     * @param  \Illuminate\Http\Testing\File  $file
     * @return array
     */
    protected function input($user, $file)
    {
        $user['avatar'] = $file;

        return $user;
    }

    /**
     * Get result attributes for admin.
     *
     * @param  array  $user
     * @param  \Illuminate\Http\Testing\File  $file
     * @return array
     */
    protected function resultForAdmin($user, $file)
    {
        $user['avatar'] = 'avatars/'.$file->hashName();

        return $user;
    }

    /**
     * Get result attributes for employee.
     *
     * @param  array  $user
     * @return array
     */
    protected function resultForEmployee($user)
    {
        return collect($user)
            ->only(['facebook', 'instagram', 'slack', 'phone', 'skype', 'github', 'bio'])
            ->all();
    }
}
