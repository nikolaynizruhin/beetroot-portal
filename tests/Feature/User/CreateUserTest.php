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

        Storage::fake('public');
        Notification::fake();
        Image::shouldReceive('make->fit->save')->once();

        $this->actingAs($admin)
            ->post(route('users.store'), $params = $this->validParams(['avatar' => $file]))
            ->assertSessionHas('status', 'The beetroot was successfully created!');

        $params['avatar'] = 'avatars/'.$file->hashName();

        $this->assertDatabaseHas('users', array_except($params, ['password', 'password_confirmation']));
        Storage::disk('public')->assertExists('avatars/'.$file->hashName());
    }

    /** @test */
    public function admin_can_create_a_user_without_avatar()
    {
        $admin = factory(User::class)->states('admin')->create();

        Notification::fake();

        $this->actingAs($admin)
            ->post(route('users.store'), $params = $this->validParams())
            ->assertSessionHas('status', 'The beetroot was successfully created!');

        $params['avatar'] = User::DEFAULT_AVATAR;

        $this->assertDatabaseHas('users', array_except($params, ['password', 'password_confirmation']));
    }

    /** @test */
    public function it_should_send_welcome_email_when_user_created()
    {
        $admin = factory(User::class)->states('admin')->create();

        Notification::fake();

        $this->actingAs($admin)
            ->post(route('users.store'), $params = $this->validParams())
            ->assertSessionHas('status', 'The beetroot was successfully created!');

        Notification::assertSentTo(
            User::whereEmail($params['email'])->first(),
            WelcomeNotification::class,
            function ($notification, $channels) use ($params) {
                return $notification->password === $params['password'];
            }
        );
    }

    /** @test */
    public function admin_can_create_a_user_with_tags()
    {
        $admin = factory(User::class)->states('admin')->create();
        $tag = factory(Tag::class)->create();

        Notification::fake();

        $this->actingAs($admin)
            ->post(route('users.store'), $this->validParams(['tags' => [$tag->id]]))
            ->assertSessionHas('status', 'The beetroot was successfully created!');

        $this->assertCount(1, $tag->users);
    }

    /** @test */
    public function some_of_user_fields_are_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->from(route('users.create'))
            ->post(route('users.store'))
            ->assertRedirect(route('users.create'))
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

        $this->actingAs($admin)
            ->from(route('users.create'))
            ->post(route('users.store'), $this->validParams(['email' => 'wrong']))
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_should_be_unique()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();

        $this->actingAs($admin)
            ->from(route('users.create'))
            ->post(route('users.store'), $this->validParams(['email' => $user->email]))
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function position_should_exist_in_position_list()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->from(route('users.create'))
            ->post(route('users.store'), $this->validParams(['position' => 'wrong']))
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors('position');
    }

    /** @test */
    public function gender_should_be_valid_gender()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->from(route('users.create'))
            ->post(route('users.store'), $this->validParams(['gender' => 'wrong']))
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors('gender');
    }

    /** @test */
    public function birthday_should_be_date_before_today()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->from(route('users.create'))
            ->post(route('users.store'), $this->validParams(['birthday' => now()]))
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors('birthday');
    }

    /** @test */
    public function password_should_match_with_password_confirmation()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->from(route('users.create'))
            ->post(route('users.store'), $this->validParams([
                'password' => 'secret',
                'password_confirmation' => 'different',
            ]))->assertRedirect(route('users.create'))
            ->assertSessionHasErrors('password');
    }

    /** @test */
    public function password_should_be_min_six_chars()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->from(route('users.create'))
            ->post(route('users.store'), $this->validParams([
                'password' => 'short',
                'password_confirmation' => 'short',
            ]))->assertRedirect(route('users.create'))
            ->assertSessionHasErrors('password');
    }

    /**
     * Get valid user params.
     *
     * @param  array  $overrides
     * @return array
     */
    private function validParams($overrides = [])
    {
        $user = factory(User::class)->make([
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])->makeHidden(['avatar', 'accepted_at'])
            ->makeVisible('password')
            ->toArray();

        return array_merge($user, $overrides);
    }
}
