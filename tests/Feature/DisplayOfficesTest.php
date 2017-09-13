<?php

namespace Tests\Feature;

use App\User;
use App\Office;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayOfficesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Guest can not see offices.
     *
     * @return void
     */
    public function testGuestCanNotSeeOffices()
    {
        $this->get(route('offices.index'))
            ->assertRedirect(route('login'));
    }

    /**
     * User can see offices.
     *
     * @return void
     */
    public function testUserCanSeeOffices()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('offices.index'))
            ->assertSee('Offices')
            ->assertStatus(200);
    }
}
