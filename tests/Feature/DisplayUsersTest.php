<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayUsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Guest can not see users.
     *
     * @return void
     */
    public function testGuestCanNotSeeUsers()
    {
        $this->get(route('users.index'))
            ->assertRedirect(route('login'));
    }

    /**
     * User can see users.
     *
     * @return void
     */
    public function testUserCanSeeUsers()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('users.index'))
            ->assertSee('Employees')
            ->assertStatus(200);
    }
}
