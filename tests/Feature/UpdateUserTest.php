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
     * User utility.
     *
     * @var object
     */
    private $userUtility;

    /**
     * Setup
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->file = UploadedFile::fake()->image('avatar.jpg');
        $this->userUtility = resolve(\Tests\Utilities\User::class);
    }

    /**
     * Only user can update own profile.
     *
     * @return void
     */
    public function testOnlyUserCanUpdateOwnProfile()
    {
        $owner = factory(User::class)->create(['is_admin' => false]);
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->put(route('profile.update', $owner->id))
            ->assertRedirect('login');

        $this->put(route('users.update', $owner->id))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->put(route('profile.update', $owner->id))
            ->assertStatus(403);

        $this->actingAs($user)
            ->put(route('users.update', $owner->id))
            ->assertStatus(403);

        $this->actingAs($owner)
            ->put(route('users.update', $owner->id))
            ->assertStatus(403);
    }

    /**
     * Only admin can visit user settings page.
     *
     * @return void
     */
    public function testOnlyAdminCanVisitUserSettingsPage()
    {
        $user = factory(User::class)->create(['is_admin' => false]);
        $userToEdit = factory(User::class)->create(['is_admin' => false]);

        $this->get(route('users.edit', $userToEdit->id))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->get(route('users.edit', $userToEdit->id))
            ->assertStatus(403);
    }

    /**
     * User can visit own settings page.
     *
     * @return void
     */
    public function testUserCanVisitOwnSettingsPage()
    {
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($user)
            ->get(route('users.edit', $user->id))
            ->assertStatus(200)
            ->assertSee('Settings')
            ->assertSee('Profile')
            ->assertSee('Change Password')
            ->assertSee($user->name);
    }

    /**
     * Admin can visit user setting page.
     *
     * @return void
     */
    public function testAdminCanVisitUserSettingsPage()
    {
        $admin = factory(User::class)->states('admin')->create();
        $userToEdit = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($admin)
            ->get(route('users.edit', $userToEdit->id))
            ->assertStatus(200)
            ->assertSee('Settings')
            ->assertSee('Profile')
            ->assertSee('Change Password')
            ->assertSee($userToEdit->name);
    }

    /**
     * Admin can update user profile.
     *
     * @return void
     */
    public function testAdminCanUpdateUserProfile()
    {
        $owner = factory(User::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        Storage::fake('public');
        Image::shouldReceive('make->fit->save')->once();

        $inputAttributes = $this->getInputAttributes();
        $resultAttributes = $this->getResultAttributesForAdmin();

        $this->actingAs($admin)
            ->put(route('users.update', $owner->id), $inputAttributes)
            ->assertSessionHas('status', 'The employee was successfully updated!');

        $this->assertDatabaseHas('users', $resultAttributes);

        Storage::disk('public')->assertExists('avatars/' . $this->file->hashName());
    }

    /**
     * User can update own profile.
     *
     * @return void
     */
    public function testUserCanUpdateOwnProfile()
    {
        $owner = factory(User::class)->create(['is_admin' => false]);

        $inputAttributes = $this->getInputAttributes();
        $resultAttributes = $this->getResultAttributesForEmployee();

        $this->actingAs($owner)
            ->put(route('profile.update', $owner->id), $inputAttributes)
            ->assertSessionHas('status', 'The employee was successfully updated!');

        $this->assertDatabaseHas('users', $resultAttributes);
    }

    /**
     * User fields are required.
     *
     * @return void
     */
    public function testUserFieldsAreRequired()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->put(route('users.update', $admin->id))
            ->assertSessionHasErrors(['name', 'position', 'birthday', 'slack', 'client_id', 'office_id']);
    }

    /**
     * Get input attributes for admin.
     *
     * @return array
     */
    private function getInputAttributes()
    {
        $this->userUtility->setAttribute('avatar', $this->file);

        return $this->userUtility->getAttributes();
    }

    /**
     * Get result attributes for admin.
     *
     * @return array
     */
    private function getResultAttributesForAdmin()
    {
        $this->userUtility->setAttribute('avatar', 'avatars/' . $this->file->hashName());

        return $this->userUtility->getAttributes();
    }

    /**
     * Get result attributes for employee.
     *
     * @return array
     */
    private function getResultAttributesForEmployee()
    {
        $this->userUtility->removeAttributes([
            'name', 'email', 'position', 'birthday', 'is_admin', 'slack', 'avatar', 'client_id', 'office_id'
        ]);

        return $this->userUtility->getAttributes();
    }
}
