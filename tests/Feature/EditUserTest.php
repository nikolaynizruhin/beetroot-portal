<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Tests\Unit\UserTest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The list of attributes.
     *
     * @var array
     */
    private $attributes = [];

    /**
     * The avatar file.
     *
     * @var array
     */
    private $file;

    /**
     * Set up.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->attributes = \Tests\Utilities\User::getAttributes();
        $this->file = UploadedFile::fake()->image('avatar.jpg');
    }

    /**
     * Only user can edit own profile.
     *
     * @return void
     */
    public function testOnlyUserCanEditOwnProfile()
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
     * Admin can edit user profile.
     *
     * @return void
     */
    public function testAdminCanEditUserProfile()
    {
        $owner = factory(User::class)->create();
        $admin = factory(User::class)->create(['is_admin' => true]);

        Storage::fake('public');

        $this->actingAs($admin)
            ->put(route('users.update', $owner->id), \Tests\Utilities\User::getInputAttributes($this->attributes, $this->file))
            ->assertSessionHas('status', 'The user was successfully updated!');

        $this->assertDatabaseHas('users', \Tests\Utilities\User::getResultAttributes($this->attributes, $this->file));

        Storage::disk('public')->assertExists('avatars/' . $this->file->hashName());
    }

    /**
     * User can edit own profile.
     *
     * @return void
     */
    public function testUserCanEditOwnProfile()
    {
        $owner = factory(User::class)->create(['is_admin' => false]);

        Storage::fake('public');

        $resultAttributes = \Tests\Utilities\User::getResultAttributes($this->attributes, $this->file);
        $resultAttributes['is_admin'] = false;

        $this->actingAs($owner)
            ->put(route('users.update', $owner->id), \Tests\Utilities\User::getInputAttributes($this->attributes, $this->file))
            ->assertSessionHas('status', 'The user was successfully updated!');

        $this->assertDatabaseHas('users', $resultAttributes);

        Storage::disk('public')->assertExists('avatars/' . $this->file->hashName());
    }
}
