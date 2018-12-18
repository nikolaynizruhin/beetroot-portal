<?php

namespace Tests\Feature\User;

use App\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_delete_a_user()
    {
        $userToDelete = factory(User::class)->create();

        $this->delete(route('users.destroy', $userToDelete))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_delete_a_user()
    {
        $user = factory(User::class)->states('unacceptable')->create();
        $userToDelete = factory(User::class)->create();

        $this->actingAs($user)
            ->delete(route('users.destroy', $userToDelete))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function employee_can_not_delete_a_user()
    {
        $userToDelete = factory(User::class)->create();
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->delete(route('users.destroy', $userToDelete))
            ->assertStatus(403);
    }

    /** @test */
    public function admin_can_delete_a_user()
    {
        $userToDelete = factory(User::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->delete(route('users.destroy', $userToDelete))
            ->assertSessionHas('status', 'The beetroot was successfully deleted!');

        $this->assertDatabaseMissing('users', $userToDelete->toArray());
    }

    /** @test */
    public function avatar_should_be_deleted_along_with_user()
    {
        Storage::fake('public');

        Image::shouldReceive('make->fit->save')->once();

        $avatar = UploadedFile::fake()
            ->image('avatar.jpg')
            ->store('avatars');

        $userToDelete = factory(User::class)->create(['avatar' => $avatar]);
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->delete(route('users.destroy', $userToDelete))
            ->assertSessionHas('status', 'The beetroot was successfully deleted!');

        Storage::disk('public')->assertMissing($userToDelete->avatar);
    }
}
