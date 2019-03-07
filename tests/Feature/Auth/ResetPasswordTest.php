<?php

namespace Tests\Feature\Auth;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_visit_reset_password_page()
    {
        $this->get(route('password.request'))
            ->assertStatus(200)
            ->assertSee('Send Password Reset Link');
    }

    /** @test */
    public function guest_can_visit_reset_password_page_with_token()
    {
        $user = factory(User::class)->create();

        $token = Password::broker()->createToken($user);

        $this->get(route('password.reset', ['token' => $token]))
            ->assertSuccessful()
            ->assertViewIs('auth.passwords.reset')
            ->assertViewHas('token', $token);
    }

    /** @test */
    public function it_redirects_to_dashboard_page_if_logged_in_employee_visit_reset_password_page()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('password.request'))
            ->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function only_existing_employee_can_reset_password()
    {
        $this->post(route('password.email'), ['email' => 'not_existing@example.com'])
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function employee_can_receive_reset_password_email()
    {
        $user = factory(User::class)->create();
        $token = null;

        Notification::fake();

        $this->post(route('password.email'), ['email' => $user->email])
            ->assertSessionHas('status', 'We have e-mailed your password reset link!');

        Notification::assertSentTo(
            $user,
            ResetPassword::class,
            function ($notification, $channels) use (&$token) {
                $token = $notification->token;

                return true;
            }
        );

        $this->post('password/reset', [
            'email' => $user->email,
            'token' => $token,
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ])->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function employee_can_not_reset_password_with_invalid_token()
    {
        $user = factory(User::class)->create();
        $token = 'invalid-token';

        $this->from(route('password.reset', ['token' => $token]))
            ->post(url('/password/reset'), [
                'token' => $token,
                'email' => $user->email,
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ])->assertRedirect(route('password.reset', ['token' => $token]));

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
        $this->assertGuest();
    }

    /** @test */
    public function employee_can_not_reset_password_without_providing_a_new_password()
    {
        $user = factory(User::class)->create();
        $token = Password::broker()->createToken($user);

        $this->from(route('password.reset', ['token' => $token]))
            ->post(url('/password/reset'), [
                'token' => $token,
                'email' => $user->email,
                'password' => '',
                'password_confirmation' => '',
            ])->assertRedirect(route('password.reset', ['token' => $token]))
            ->assertSessionHasErrors('password');

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
        $this->assertGuest();
    }

    /** @test */
    public function employee_can_not_reset_password_without_proving_an_email()
    {
        $user = factory(User::class)->create();
        $token = Password::broker()->createToken($user);

        $this->from(route('password.reset', ['token' => $token]))
            ->post(url('/password/reset'), [
                'token' => $token,
                'email' => '',
                'password' => 'new-awesome-password',
                'password_confirmation' => 'new-awesome-password',
            ])->assertRedirect(route('password.reset', ['token' => $token]))
            ->assertSessionHasErrors('email');

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
        $this->assertGuest();
    }
}
