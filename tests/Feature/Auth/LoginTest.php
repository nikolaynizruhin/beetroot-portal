<?php

namespace Tests\Feature\Auth;

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
    public function employee_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user)
            ->get(route('login'))
            ->assertRedirect('/dashboard');
    }

    /** @test */
    public function it_should_throw_unauthenticated_on_guest_json_requests()
    {
        $this->json('GET', route('dashboard'))
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    /** @test */
    public function employee_can_login()
    {
        $user = factory(User::class)->create();

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
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
            'password' => 'password',
            'remember' => 'on',
        ])->assertRedirect(route('dashboard'))
            ->assertCookieNotExpired(Auth::guard()->getRecallerName());

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function only_existed_employees_can_login()
    {
        $this->from(route('login'))->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'password',
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
