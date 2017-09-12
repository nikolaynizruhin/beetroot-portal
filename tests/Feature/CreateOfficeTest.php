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
     * Only admin can visit create an office page.
     *
     * @return void
     */
    public function testOnlyAdminCanVisitCreateAnOfficePage()
    {
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->get(route('offices.create'))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->get(route('offices.create'))
            ->assertStatus(403);
    }

    /**
     * Admin can visit create office page.
     *
     * @return void
     */
    public function testAdminCanVisitCreateOfficePage()
    {
        $user = factory(User::class)->states('admin')->create();

        $this->actingAs($user)
            ->get(route('offices.create'))
            ->assertStatus(200)
            ->assertSee('Add Office');
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
