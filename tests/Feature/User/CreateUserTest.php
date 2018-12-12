<?php

namespace Tests\Feature\User;

use App\Tag;
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
        $file = UploadedFile::fake()->image('avatar.jpg');

        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->make([
            'avatar' => $file,
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])->makeHidden('accepted_at')
            ->makeVisible('password');

        Storage::fake('public');
        Notification::fake();
        Image::shouldReceive('make->fit->save')->once();

        $this->actingAs($admin)
            ->post(route('users.store'), $user->toArray())
            ->assertSessionHas('status', 'The beetroot was successfully created!');

        $user->avatar = 'avatars/'.$file->hashName();
        $user->makeHidden(['password', 'password_confirmation']);

        $this->assertDatabaseHas('users', $user->toArray());
        Storage::disk('public')->assertExists('avatars/'.$file->hashName());
    }

    /** @test */
    public function admin_can_create_a_user_without_avatar()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->make([
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])->makeHidden(['avatar', 'accepted_at'])
            ->makeVisible('password');

        Notification::fake();

        $this->actingAs($admin)
            ->post(route('users.store'), $user->toArray())
            ->assertSessionHas('status', 'The beetroot was successfully created!');

        $user->avatar = User::DEFAULT_AVATAR;
        $user->makeHidden(['password', 'password_confirmation']);

        $this->assertDatabaseHas('users', $user->toArray());
    }

    /** @test */
    public function it_should_send_welcome_email_when_user_created()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->make([
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])->makeHidden(['avatar', 'accepted_at'])
            ->makeVisible('password');

        Notification::fake();

        $this->actingAs($admin)
            ->post(route('users.store'), $user->toArray())
            ->assertSessionHas('status', 'The beetroot was successfully created!');

        Notification::assertSentTo(
            User::whereEmail($user->email)->first(),
            WelcomeNotification::class,
            function ($notification, $channels) use ($user) {
                return $notification->password === $user->password;
            }
        );
    }

    /** @test */
    public function admin_can_create_a_user_with_tags()
    {
        $admin = factory(User::class)->states('admin')->create();
        $tag = factory(Tag::class)->create();
        $user = factory(User::class)
            ->states('admin')
            ->make([
                'password' => 'secret',
                'password_confirmation' => 'secret',
                'tags' => [$tag->id],
            ])
            ->makeHidden(['avatar', 'accepted_at'])
            ->makeVisible('password')
            ->toArray();

        Notification::fake();

        $this->actingAs($admin)
            ->post(route('users.store'), $user)
            ->assertSessionHas('status', 'The beetroot was successfully created!');

        $this->assertCount(1, $tag->users);
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

    /** @test */
    public function email_should_be_valid()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->make([
            'email' => 'wrong',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])->makeVisible('password');

        $this->actingAs($admin)
            ->post(route('users.store'), $user->toArray())
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_should_be_unique()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();
        $userWithSameEmail = factory(User::class)->make([
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])->makeVisible('password');

        $this->actingAs($admin)
            ->post(route('users.store'), $userWithSameEmail->toArray())
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function position_should_exist_in_position_list()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->make([
            'position' => 'wrong',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])->makeVisible('password');

        $this->actingAs($admin)
            ->post(route('users.store'), $user->toArray())
            ->assertSessionHasErrors('position');
    }

    /** @test */
    public function gender_should_be_valid_gender()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->make([
            'gender' => 'wrong',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])->makeVisible('password');

        $this->actingAs($admin)
            ->post(route('users.store'), $user->toArray())
            ->assertSessionHasErrors('gender');
    }

    /** @test */
    public function birthday_should_be_date_before_today()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->make([
            'birthday' => now(),
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])->makeVisible('password');

        $this->actingAs($admin)
            ->post(route('users.store'), $user->toArray())
            ->assertSessionHasErrors('birthday');
    }

    /** @test */
    public function created_date_should_be_date_before_tomorrow()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->make([
            'created_at' => now()->addDays(1),
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])->makeVisible('password');

        $this->actingAs($admin)
            ->post(route('users.store'), $user->toArray())
            ->assertSessionHasErrors('created_at');
    }
}
