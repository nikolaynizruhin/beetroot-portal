<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Only admin can create user.
     *
     * @return void
     */
    public function testOnlyAdminCanCreateUser()
    {
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->post(route('users.store'))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->post(route('users.store'))
            ->assertStatus(403);
    }

    /**
     * Admin can create a user.
     *
     * @return void
     */
    public function testAdminCanCreateAUser()
    {
        $admin = factory(User::class)->states('admin')->create();

        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');
        $attributes = \Tests\Utilities\User::getAttributes();
        $attributes['password'] = 'secret';
        $attributes['password_confirmation'] = 'secret';

        $resultAttributes = \Tests\Utilities\User::getAttributes();

        $this->actingAs($admin)
            ->post(route('users.store'), \Tests\Utilities\User::getInputAttributes($attributes, $file))
            ->assertSessionHas('status', 'The user was successfully created!');

        $this->assertDatabaseHas('users', \Tests\Utilities\User::getResultAttributes($resultAttributes, $file));

        Storage::disk('public')->assertExists('avatars/' . $file->hashName());
    }
}
