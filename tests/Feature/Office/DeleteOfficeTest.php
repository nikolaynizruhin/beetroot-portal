<?php

namespace Tests\Feature\Office;

use App\User;
use App\Office;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteOfficeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_delete_an_office()
    {
        $office = factory(Office::class)->create();

        $this->delete(route('offices.destroy', $office))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_delete_an_office()
    {
        $user = factory(User::class)->states('unacceptable')->create();
        $office = factory(Office::class)->create();

        $this->actingAs($user)
            ->delete(route('offices.destroy', $office))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function employee_can_not_delete_an_office()
    {
        $office = factory(Office::class)->create();
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->delete(route('offices.destroy', $office))
            ->assertForbidden();
    }

    /** @test */
    public function admin_can_delete_an_office()
    {
        $office = factory(Office::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->delete(route('offices.destroy', $office))
            ->assertSessionHas('status', 'The location was successfully deleted!');

        $this->assertDatabaseMissing('users', $office->toArray());
    }

    /** @test */
    public function activities_should_be_deleted_along_with_office()
    {
        $office = factory(Office::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->delete(route('offices.destroy', $office))
            ->assertSessionHas('status', 'The location was successfully deleted!');

        $this->assertTrue($office->activities->isEmpty());
    }
}
