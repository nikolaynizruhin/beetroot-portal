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
     * @var array
     */
    private $user;

    /**
     * Setup.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->file = UploadedFile::fake()->image('avatar.jpg');
        $this->user = factory(User::class)->states('admin')->make()
            ->makeHidden(['avatar', 'accepted_at'])
            ->toArray();
    }

    /** @test */
    public function guest_can_not_update_employee_profile()
    {
        $owner = factory(User::class)->states('employee')->create();

        $this->put(route('profile.update', $owner))
            ->assertRedirect(route('login'));

        $this->put(route('users.update', $owner))
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
    public function employee_can_not_update_another_employee_profile()
    {
        $owner = factory(User::class)->states('employee')->create();
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->put(route('profile.update', $owner))
            ->assertStatus(403);

        $this->actingAs($user)
            ->put(route('users.update', $owner))
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

        Storage::fake('public');
        Image::shouldReceive('make->fit->save')->once();

        $input = $this->input();
        $result = $this->resultForAdmin();

        $this->actingAs($admin)
            ->put(route('users.update', $owner), $input)
            ->assertSessionHas('status', 'The employee was successfully updated!');

        $this->assertDatabaseHas('users', $result);

        Storage::disk('public')->assertExists('avatars/'.$this->file->hashName());
    }

    /** @test */
    public function employee_can_update_own_profile()
    {
        $owner = factory(User::class)->states('employee')->create();

        $input = $this->input();
        $result = $this->resultForEmployee();

        $this->actingAs($owner)
            ->put(route('profile.update', $owner), $input)
            ->assertSessionHas('status', 'The employee was successfully updated!');

        $this->assertDatabaseHas('users', $result);
    }

    /** @test */
    public function some_of_employee_fields_are_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->put(route('users.update', $admin))
            ->assertSessionHasErrors([
                'name',
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
     * @return array
     */
    protected function input()
    {
        $this->user['avatar'] = $this->file;

        return $this->user;
    }

    /**
     * Get result attributes for admin.
     *
     * @return array
     */
    protected function resultForAdmin()
    {
        $this->user['avatar'] = 'avatars/'.$this->file->hashName();

        return $this->user;
    }

    /**
     * Get result attributes for employee.
     *
     * @return array
     */
    protected function resultForEmployee()
    {
        return collect($this->user)
            ->only(['facebook','instagram','slack','phone','skype','github','bio'])
            ->all();
    }
}
