<?php

namespace Tests\Feature;

use App\User;
use App\Office;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateOfficeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Only admin can create an office.
     *
     * @return void
     */
    public function testOnlyAdminCanCreateAnOffice()
    {
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->post(route('offices.store'))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->post(route('offices.store'))
            ->assertStatus(403);
    }

    /**
     * Admin can create an office.
     *
     * @return void
     */
    public function testAdminCanCreateAnOffice()
    {
        $admin = factory(User::class)->states('admin')->create();

        $attributes = factory(Office::class)->make()->toArray();

        $this->actingAs($admin)
            ->post(route('offices.store'), $attributes)
            ->assertSessionHas('status', 'The office was successfully created!');

        $this->assertDatabaseHas('offices', $attributes);
    }

    /**
     * Office fields are required.
     *
     * @return void
     */
    public function testOfficeFieldsAreRequired()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->post(route('offices.store'))
            ->assertSessionHasErrors(['city', 'country', 'address']);
    }
}
