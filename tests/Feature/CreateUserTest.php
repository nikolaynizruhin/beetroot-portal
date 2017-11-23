<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserTest extends TestCase
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
     * Only admin can create user.
     *
     * @return void
     */
    public function testOnlyAdminCanCreateUser()
    {
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->post(route('users.store'))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->post(route('users.store'))
            ->assertStatus(403);
    }

    /**
     * Only admin can visit create user page.
     *
     * @return void
     */
    public function testOnlyAdminCanVisitCreateUserPage()
    {
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->get(route('users.create'))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->get(route('users.create'))
            ->assertStatus(403);
    }

    /**
     * Admin can visit create user page.
     *
     * @return void
     */
    public function testAdminCanVisitCreateUserPage()
    {
        $user = factory(User::class)->states('admin')->create();

        $this->actingAs($user)
            ->get(route('users.create'))
            ->assertStatus(200)
            ->assertSee('Add Employee');
    }

    /**
     * Admin can create a user.
     *
     * @return void
     */
    public function testAdminCanCreateAUser()
    {
        $admin = factory(User::class)->states('admin')->create();

        Storage::fake('public');

        Image::shouldReceive('make->fit->save')->once();

        $inputAttributes = $this->getInputAttributes();
        $resultAttributes = $this->getResultAttributes();

        $this->actingAs($admin)
            ->post(route('users.store'), $inputAttributes)
            ->assertSessionHas('status', 'The employee was successfully created!');

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
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->post(route('users.store'))
            ->assertSessionHasErrors(['name', 'email', 'position', 'birthday', 'slack', 'client_id', 'office_id', 'password', 'avatar']);
    }

    /**
     * Get input attributes.
     *
     * @return array
     */
    private function getInputAttributes()
    {
        $this->userUtility->setAttribute('avatar', $this->file);
        $this->userUtility->setAttribute('password', 'secret');
        $this->userUtility->setAttribute('password_confirmation', 'secret');

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
        $this->userUtility->removeAttribute('password');
        $this->userUtility->removeAttribute('password_confirmation');

        return $this->userUtility->getAttributes();
    }
}
