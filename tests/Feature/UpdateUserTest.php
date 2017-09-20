<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
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
        $owner = factory(User::class)->create();
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->put(route('users.update', $owner->id))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->put(route('users.update', $owner->id))
            ->assertStatus(403);
    }

    /**
     * Only admin can visit edit user page.
     *
     * @return void
     */
    public function testOnlyAdminCanVisitEditUserPage()
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
     * User can visit own profile page.
     *
     * @return void
     */
    public function testUserCanVisitOwnProfilePage()
    {
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($user)
            ->get(route('users.edit', $user->id))
            ->assertStatus(200)
            ->assertSee('Profile')
            ->assertSee($user->name);
    }

    /**
     * Admin can visit profile user page.
     *
     * @return void
     */
    public function testAdminCanVisitProfileUserPage()
    {
        $admin = factory(User::class)->states('admin')->create();
        $userToEdit = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($admin)
            ->get(route('users.edit', $userToEdit->id))
            ->assertStatus(200)
            ->assertSee('Profile')
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

        $inputAttributes = $this->getInputAttributes();
        $resultAttributes = $this->getResultAttributes();

        $this->actingAs($admin)
            ->put(route('users.update', $owner->id), $inputAttributes)
            ->assertSessionHas('status', 'The user was successfully updated!');

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

        Storage::fake('public');

        $inputAttributes = $this->getInputAttributes();
        $resultAttributes = $this->getResultAttributes();
        $resultAttributes['email'] = $owner->email;
        $resultAttributes['is_admin'] = false;

        $this->actingAs($owner)
            ->put(route('users.update', $owner->id), $inputAttributes)
            ->assertSessionHas('status', 'The user was successfully updated!');

        $this->assertDatabaseHas('users', $resultAttributes);

        Storage::disk('public')->assertExists('avatars/' . $this->file->hashName());
    }

    /**
     * User fields are required.
     *
     * @return void
     */
    public function testUserFieldsAreRequired()
    {
        $owner = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($owner)
            ->put(route('users.update', $owner->id))
            ->assertSessionHasErrors(['name', 'position', 'birthday', 'slack', 'client_id', 'office_id']);
    }

    /**
     * Get input attributes.
     *
     * @return array
     */
    private function getInputAttributes()
    {
        $this->userUtility->setAttribute('avatar', $this->file);

        return $this->userUtility->getAttributes();
    }

    /**
     * Get result attributes.
     *
     * @return array
     */
    private function getResultAttributes()
    {
        $this->userUtility->setAttribute('avatar', 'avatars/' . $this->file->hashName());

        return $this->userUtility->getAttributes();
    }
}
