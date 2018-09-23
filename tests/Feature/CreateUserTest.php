<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_create_a_user()
    {
        $this->post(route('users.store'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_create_a_user()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->post(route('users.store'))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function employee_can_not_create_a_user()
    {
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->post(route('users.store'))
            ->assertStatus(403);
    }

    /** @test */
    public function guest_can_not_visit_create_user_page()
    {
        $this->get(route('users.create'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_can_not_visit_create_user_page()
    {
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->get(route('users.create'))
            ->assertStatus(403);
    }

    /** @test */
    public function admin_can_visit_create_user_page()
    {
        $user = factory(User::class)->states('admin')->create();

        $this->actingAs($user)
            ->get(route('users.create'))
            ->assertSuccessful()
            ->assertViewIs('users.create');
    }

    /** @test */
    public function admin_can_create_a_user()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->states('admin')->make()
            ->makeHidden(['avatar', 'accepted_at'])
            ->toArray();

        $file = UploadedFile::fake()->image('avatar.jpg');

        Storage::fake('public');

        Notification::fake();

        Image::shouldReceive('make->fit->save')->once();

        $this->actingAs($admin)
            ->post(route('users.store'), $this->input($user, $file))
            ->assertSessionHas('status', 'The beetroot was successfully created!');

        $this->assertDatabaseHas('users', $this->result($user, $file));

        Storage::disk('public')->assertExists('avatars/'.$file->hashName());
    }

    /** @test */
    public function admin_can_create_a_user_without_avatar()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->states('admin')->make()
            ->makeHidden(['avatar', 'accepted_at'])
            ->toArray();

        Notification::fake();

        $this->actingAs($admin)
            ->post(route('users.store'), $this->input($user))
            ->assertSessionHas('status', 'The beetroot was successfully created!');

        $this->assertDatabaseHas('users', $this->result($user));
    }

    /** @test */
    public function it_should_send_welcome_email_when_user_created()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->states('admin')->make()
            ->makeHidden(['avatar', 'accepted_at'])
            ->toArray();

        Notification::fake();

        $this->actingAs($admin)
            ->post(route('users.store'), $input = $this->input($user))
            ->assertSessionHas('status', 'The beetroot was successfully created!');

        Notification::assertSentTo(
            User::whereEmail($input['email'])->first(),
            WelcomeNotification::class,
            function ($notification, $channels) use ($input) {
                return $notification->password === $input['password'];
            }
        );
    }

    /** @test */
    public function some_of_user_fields_are_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->post(route('users.store'))
            ->assertSessionHasErrors([
                'name',
                'gender',
                'email',
                'position',
                'birthday',
                'created_at',
                'client_id',
                'office_id',
                'password',
            ]);
    }

    /**
     * Get input attributes.
     *
     * @param  array  $user
     * @param  object|null  $file
     * @return array
     */
    protected function input($user, $file = null)
    {
        if ($file) {
            $user['avatar'] = $file;
        }

        $user['password'] = $user['password_confirmation'] = 'secret';

        return $user;
    }

    /**
     * Get result attributes.
     *
     * @param  array  $user
     * @param  object|null  $file
     * @return array
     */
    protected function result($user, $file = null)
    {
        $user['avatar'] = $file ? 'avatars/'.$file->hashName() : User::DEFAULT_AVATAR;

        unset($user['password'], $user['password_confirmation']);

        return $user;
    }
}
