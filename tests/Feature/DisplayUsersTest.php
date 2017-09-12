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
        $users = factory(User::class, 3)->create();

        $firstUser = $users->first();
        $lastUser = $users->last();

        $this->actingAs($firstUser)
            ->get(route('users.index'))
            ->assertSee('Users')
            ->assertSee($firstUser->name)
            ->assertSee($firstUser->email)
            ->assertSee($lastUser->name)
            ->assertSee($lastUser->email);
    }
}
