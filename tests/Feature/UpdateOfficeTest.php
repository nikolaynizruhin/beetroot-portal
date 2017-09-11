<?php

namespace Tests\Feature;

use App\User;
use App\Office;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateOfficeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Only admin can update an office.
     *
     * @return void
     */
    public function testOnlyAdminCanUpdateAnOffice()
    {
        $office = factory(Office::class)->create();
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->put(route('offices.update', $office->id))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->put(route('offices.update', $office->id))
            ->assertStatus(403);
    }

    /**
     * Admin can update an office.
     *
     * @return void
     */
    public function testAdminCanUpdateAnOffice()
    {
        $office = factory(Office::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $attributes = factory(Office::class)->make()->toArray();

        $this->actingAs($admin)
            ->put(route('offices.update', $office->id), $attributes)
            ->assertSessionHas('status', 'The office was successfully updated!');

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
        $office = factory(Office::class)->create();

        $this->actingAs($admin)
            ->put(route('offices.update', $office->id))
            ->assertSessionHasErrors(['city', 'country', 'address']);
    }
}
