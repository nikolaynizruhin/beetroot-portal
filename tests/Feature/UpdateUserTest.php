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

    /**
     * Avatar file.
     *
     * @var object
     */
    private $file;

    /**
     * User fixture.
     *
     * @var object
     */
    private $userFixture;

    /**
     * Setup
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->file = UploadedFile::fake()->image('avatar.jpg');
        $this->userFixture = resolve(\Tests\Fixtures\UserFixture::class);
    }

    /** @test */
    public function guest_can_not_update_employee_profile()
    {
        $owner = factory(User::class)->create(['is_admin' => false]);

        $this->put(route('profile.update', $owner->id))
            ->assertRedirect('login');

        $this->put(route('users.update', $owner->id))
            ->assertRedirect('login');
    }

    /** @test */
    public function employee_can_not_update_another_employee_profile()
    {
        $owner = factory(User::class)->create(['is_admin' => false]);
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($user)
            ->put(route('profile.update', $owner->id))
            ->assertStatus(403);

        $this->actingAs($user)
            ->put(route('users.update', $owner->id))
            ->assertStatus(403);
    }

    /** @test */
    public function employee_can_not_update_own_protected_fields()
    {
        $owner = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($owner)
            ->put(route('users.update', $owner->id))
            ->assertStatus(403);
    }

    /** @test */
    public function guest_can_not_visit_employee_settings_page()
    {
        $userToEdit = factory(User::class)->create(['is_admin' => false]);

        $this->get(route('users.edit', $userToEdit->id))
            ->assertRedirect('login');
    }

    /** @test */
    public function employee_can_not_visit_another_employee_settings_page()
    {
        $user = factory(User::class)->create(['is_admin' => false]);
        $userToEdit = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($user)
            ->get(route('users.edit', $userToEdit->id))
            ->assertStatus(403);
    }

    /** @test */
    public function employee_can_visit_own_settings_page()
    {
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($user)
            ->get(route('users.edit', $user->id))
            ->assertStatus(200)
            ->assertSee('Settings')
            ->assertSee('Profile')
            ->assertSee('Change Password')
            ->assertDontSee('Delete Account')
            ->assertSee($user->name);
    }

    /** @test */
    public function admin_can_visit_any_employee_settings_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $userToEdit = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($admin)
            ->get(route('users.edit', $userToEdit->id))
            ->assertStatus(200)
            ->assertSee('Settings')
            ->assertSee('Profile')
            ->assertSee('Change Password')
            ->assertSee('Delete Account')
            ->assertSee($userToEdit->name);
    }

    /** @test */
    public function admin_can_update_any_employee_profile()
    {
        $owner = factory(User::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        Storage::fake('public');
        Image::shouldReceive('make->fit->save')->once();

        $input = $this->inputAttributes();
        $result = $this->resultAttributesForAdmin();

        $this->actingAs($admin)
            ->put(route('users.update', $owner->id), $input)
            ->assertSessionHas('status', 'The employee was successfully updated!');

        $this->assertDatabaseHas('users', $result);

        Storage::disk('public')->assertExists('avatars/' . $this->file->hashName());
    }

    /** @test */
    public function employee_can_update_own_profile()
    {
        $owner = factory(User::class)->create(['is_admin' => false]);

        $input = $this->inputAttributes();
        $result = $this->resultAttributesForEmployee();

        $this->actingAs($owner)
            ->put(route('profile.update', $owner->id), $input)
            ->assertSessionHas('status', 'The employee was successfully updated!');

        $this->assertDatabaseHas('users', $result);
    }

    /** @test */
    public function some_of_employee_fields_are_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->put(route('users.update', $admin->id))
            ->assertSessionHasErrors([
                'name', 'email', 'position', 'birthday', 'slack', 'client_id', 'office_id'
            ]);
    }

    /**
     * Get input attributes for admin.
     *
     * @return array
     */
    private function inputAttributes()
    {
        $this->userFixture->set('avatar', $this->file);

        return $this->userFixture->attributes();
    }

    /**
     * Get result attributes for admin.
     *
     * @return array
     */
    private function resultAttributesForAdmin()
    {
        $this->userFixture->set('avatar', 'avatars/' . $this->file->hashName());

        return $this->userFixture->attributes();
    }

    /**
     * Get result attributes for employee.
     *
     * @return array
     */
    private function resultAttributesForEmployee()
    {
        $this->userFixture->remove([
            'name', 'email', 'position', 'birthday', 'is_admin', 'slack', 'avatar', 'client_id', 'office_id'
        ]);

        return $this->userFixture->attributes();
    }
}
