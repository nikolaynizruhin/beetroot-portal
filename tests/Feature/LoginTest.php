<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Everyone can visit a login page.
     *
     * @return void
     */
    public function testEveryoneCanVisitLoginPage()
    {
        $this->get(route('login'))
            ->assertStatus(200)
            ->assertSee('Login')
            ->assertSee('Email')
            ->assertSee('Password');
    }

    /**
     * Redirect to login page when try to visit register page.
     *
     * @return void
     */
    public function testRedirectToLoginPageWhenVisitRegister()
    {
        $this->get(route('register'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * User can login.
     *
     * @return void
     */
    public function testUserCanLogin()
    {
        $user = factory(User::class)->create();

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'secret',
        ])->assertStatus(302)
            ->assertRedirect(route('dashboard'));
    }

    /**
     * Only existed user can login.
     *
     * @return void
     */
    public function testOnlyExistedUserCanLogin()
    {
        $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'secret',
        ])->assertSessionHasErrors(['email']);
    }

    /**
     * User can logout.
     *
     * @return void
     */
    public function testUserCanLogout()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertStatus(302);
    }
}
