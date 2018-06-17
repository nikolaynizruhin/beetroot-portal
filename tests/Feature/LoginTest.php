<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_visit_login_page()
    {
        $this->get(route('login'))
            ->assertSuccessful()
            ->assertViewIs('auth.login');
    }

    /** @test */
    public function it_redirects_to_login_page_when_visit_register_page()
    {
        $this->get(route('register'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user)
            ->get(route('login'))
            ->assertRedirect('/dashboard');
    }

    /** @test */
    public function employee_can_login()
    {
        $user = factory(User::class)->create();

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'secret',
        ])->assertStatus(302)
            ->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_can_remember_employee()
    {
        $user = factory(User::class)->create();

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'secret',
            'remember' => 'on',
        ])->assertRedirect(route('dashboard'))
            ->assertCookie(Auth::guard()->getRecallerName(), vsprintf('%s|%s|%s', [
                $user->id,
                $user->getRememberToken(),
                $user->password,
            ]));

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function only_existed_employees_can_login()
    {
        $this->from(route('login'))->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'secret',
        ])->assertSessionHasErrors('email')
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }

    /** @test */
    public function employee_cannot_login_with_incorrect_password()
    {
        $user = factory(User::class)->create();

        $this->from(route('login'))->post(route('login'), [
            'email' => $user->email,
            'password' => 'invalid-password',
        ])->assertSessionHasErrors('email')
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }

    /** @test */
    public function logged_in_employee_can_logout()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertStatus(302);
    }

    /** @test */
    public function it_redirects_to_logout_page_if_employee_not_logged_in()
    {
        $this->post(route('logout'))
            ->assertStatus(302);
    }
}
