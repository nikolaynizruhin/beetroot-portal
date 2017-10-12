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

    /**
     * User can visit reset password page.
     *
     * @return void
     */
    public function testUserCanVisitResetPasswordPage()
    {
        $this->get(route('password.request'))
            ->assertStatus(200)
            ->assertSee('Reset Password');
    }

    /**
     * Only not auth user can visit reset password page.
     *
     * @return void
     */
    public function testOnlyNotAuthUserCanVisitResetPasswordPage()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('password.request'))
            ->assertRedirect(route('dashboard'));
    }

    /**
     * Only existing user can reset password.
     *
     * @return void
     */
    public function testOnlyExistingUserCanResetPassword()
    {
        $this->post(route('password.email'), ['email' => 'not_existing@example.com'])
            ->assertSessionHasErrors(['email']);
    }

    /**
     * User can receive reset password email.
     *
     * @return void
     */
    public function testUserCanReceiveResetPasswordEmail()
    {
        $user = factory(User::class)->create();

        Notification::fake();

        $this->post(route('password.email'), ['email' => $user->email])
            ->assertSessionHas('status', 'We have e-mailed your password reset link!');

        Notification::assertSentTo(
            [$user], ResetPassword::class
        );
    }
}
