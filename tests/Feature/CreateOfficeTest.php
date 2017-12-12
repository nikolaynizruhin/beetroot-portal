<?php

namespace Tests\Feature;

use App\User;
use App\Office;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateOfficeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_create_an_office()
    {
        $this->post(route('offices.store'))
            ->assertRedirect('login');
    }

    /** @test */
    public function employee_can_not_create_an_office()
    {
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($user)
            ->post(route('offices.store'))
            ->assertStatus(403);
    }

    /** @test */
    public function guest_can_not_visit_create_office_page()
    {
        $this->get(route('offices.create'))
            ->assertRedirect('login');
    }

    /** @test */
    public function employee_can_not_visit_create_office_page()
    {
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($user)
            ->get(route('offices.create'))
            ->assertStatus(403);
    }

    /** @test */
    public function admin_can_visit_create_office_page()
    {
        $user = factory(User::class)->states('admin')->create();

        $this->actingAs($user)
            ->get(route('offices.create'))
            ->assertStatus(200)
            ->assertSee('Add Office');
    }

    /** @test */
    public function admin_can_create_an_office()
    {
        $admin = factory(User::class)->states('admin')->create();

        $attributes = factory(Office::class)->make()->toArray();

        $this->actingAs($admin)
            ->post(route('offices.store'), $attributes)
            ->assertSessionHas('status', 'The office was successfully created!');

        $this->assertDatabaseHas('offices', $attributes);
    }

    /** @test */
    public function some_of_office_fields_are_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->post(route('offices.store'))
            ->assertSessionHasErrors(['city', 'country', 'address']);
    }
}
