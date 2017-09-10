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
            ->assertRedirect(route('home'));
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
}
