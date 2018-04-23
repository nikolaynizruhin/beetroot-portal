<?php

namespace Tests\Feature;

use App\User;
use App\Office;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateOfficeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_update_an_office()
    {
        $office = factory(Office::class)->create();

        $this->put(route('offices.update', $office))
            ->assertRedirect('login');
    }

    /** @test */
    public function employee_can_not_update_an_office()
    {
        $office = factory(Office::class)->create();
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($user)
            ->put(route('offices.update', $office))
            ->assertStatus(403);
    }

    /** @test */
    public function guest_can_not_visit_update_office_page()
    {
        $office = factory(User::class)->create();

        $this->get(route('offices.edit', $office))
            ->assertRedirect('login');
    }

    /** @test */
    public function employee_can_not_visit_update_office_page()
    {
        $user = factory(User::class)->create(['is_admin' => false]);
        $office = factory(Office::class)->create();

        $this->actingAs($user)
            ->get(route('offices.edit', $office))
            ->assertStatus(403);
    }

    /** @test */
    public function admin_can_visit_update_office_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $office = factory(Office::class)->create();

        $this->actingAs($admin)
            ->get(route('offices.edit', $office))
            ->assertStatus(200)
            ->assertSee('Update Office')
            ->assertSee('Delete Office')
            ->assertSee($office->link);
    }

    /** @test */
    public function admin_can_update_an_office()
    {
        $office = factory(Office::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $attributes = factory(Office::class)->make()->toArray();

        $this->actingAs($admin)
            ->put(route('offices.update', $office), $attributes)
            ->assertSessionHas('status', 'The office was successfully updated!');

        $this->assertDatabaseHas('offices', $attributes);
    }

    /** @test */
    public function some_of_office_fields_are_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $office = factory(Office::class)->create();

        $this->actingAs($admin)
            ->put(route('offices.update', $office))
            ->assertSessionHasErrors(['city', 'country', 'address']);
    }
}
