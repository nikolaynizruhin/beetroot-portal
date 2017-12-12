<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_visit_login_page()
    {
        $this->get(route('login'))
            ->assertStatus(200)
            ->assertSee('Login')
            ->assertSee('Email')
            ->assertSee('Password');
    }

    /** @test */
    public function it_redirects_to_login_page_when_visit_register_page()
    {
        $this->get(route('register'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
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
    }

    /** @test */
    public function only_existed_employees_can_login()
    {
        $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'secret',
        ])->assertSessionHasErrors(['email']);
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
