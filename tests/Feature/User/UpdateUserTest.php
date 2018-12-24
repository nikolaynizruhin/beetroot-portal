<?php

namespace Tests\Feature\User;

use App\Tag;
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
        $file = UploadedFile::fake()->image('avatar.jpg');

        $owner = factory(User::class)->create();
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->make(['avatar' => $file])->makeHidden('accepted_at');

        Storage::fake('public');
        Image::shouldReceive('make->fit->save')->once();

        $this->actingAs($admin)
            ->put(route('users.update', $owner), $user->toArray())
            ->assertSessionHas('status', 'The beetroot was successfully updated!');

        $user->avatar = 'avatars/'.$file->hashName();

        $this->assertDatabaseHas('users', $user->toArray());
        Storage::disk('public')->assertExists('avatars/'.$file->hashName());
    }

    /** @test */
    public function employee_can_update_own_profile()
    {
        $file = UploadedFile::fake()->image('avatar.jpg');

        $owner = factory(User::class)->states('employee')->create();
        $user = factory(User::class)->make(['avatar' => $file])->makeHidden('accepted_at');

        $this->actingAs($owner)
            ->put(route('profile.update', $owner), $user->toArray())
            ->assertSessionHas('status', 'The beetroot was successfully updated!');

        $user = collect($user->toArray())
            ->only(['facebook', 'instagram', 'slack', 'phone', 'skype', 'github', 'bio'])
            ->all();

        $this->assertDatabaseHas('users', $user);
    }

    /** @test */
    public function employee_can_update_tags()
    {
        $owner = factory(User::class)->states('employee')->create();
        $tag = factory(Tag::class)->create();

        $this->actingAs($owner)
            ->put(route('profile.update', $owner), ['tags' => [$tag->id]])
            ->assertSessionHas('status', 'The beetroot was successfully updated!');

        $this->assertCount(1, $tag->users);
    }

    /** @test */
    public function some_of_employee_fields_are_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->from(route('users.edit', $admin))
            ->put(route('users.update', $admin))
            ->assertRedirect(route('users.edit', $admin))
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

    /** @test */
    public function email_should_be_valid()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->from(route('users.edit', $admin))
            ->put(route('users.update', $admin), ['email' => 'wrong'])
            ->assertRedirect(route('users.edit', $admin))
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_should_be_unique()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();

        $this->actingAs($admin)
            ->from(route('users.edit', $admin))
            ->put(route('users.update', $admin), ['email' => $user->email])
            ->assertRedirect(route('users.edit', $admin))
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function position_should_exist_in_position_list()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->from(route('users.edit', $admin))
            ->put(route('users.update', $admin), ['position' => 'wrong'])
            ->assertRedirect(route('users.edit', $admin))
            ->assertSessionHasErrors('position');
    }

    /** @test */
    public function gender_should_be_valid_gender()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->from(route('users.edit', $admin))
            ->put(route('users.update', $admin), ['gender' => 'wrong'])
            ->assertRedirect(route('users.edit', $admin))
            ->assertSessionHasErrors('gender');
    }

    /** @test */
    public function birthday_should_be_date_before_today()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->from(route('users.edit', $admin))
            ->put(route('users.update', $admin), ['birthday' => now()])
            ->assertRedirect(route('users.edit', $admin))
            ->assertSessionHasErrors('birthday');
    }
}
