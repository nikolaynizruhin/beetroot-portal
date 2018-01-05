<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
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
        $this->get(url('password/reset/token'))
            ->assertStatus(200)
            ->assertSee('E-Mail Address')
            ->assertSee('Password')
            ->assertSee('Confirm Password');
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
            ->assertSessionHasErrors(['email']);
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
        ])
            ->assertRedirect(route('dashboard'));
    }
}
