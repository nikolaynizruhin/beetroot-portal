<?php

namespace Tests\Feature;

use App\User;
use App\Office;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteOfficeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Only admin can delete an office.
     *
     * @return void
     */
    public function testOnlyAdminCanDeleteAnOffice()
    {
        $office = factory(Office::class)->create();
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->delete(route('offices.destroy', $office->id))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->delete(route('offices.destroy', $office->id))
            ->assertStatus(403);
    }

    /**
     * Admin can delete an office.
     *
     * @return void
     */
    public function testAdminCanDeleteAnOffice()
    {
        $office = factory(Office::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->delete(route('offices.destroy', $office->id))
            ->assertSessionHas('status', 'The office was successfully deleted!');
    }
}
