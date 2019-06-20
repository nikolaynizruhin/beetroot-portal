<?php

namespace Tests\Feature\Client;

use App\Tag;
use App\User;
use App\Client;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateClientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_update_a_client()
    {
        $client = factory(Client::class)->create();

        $this->put(route('clients.update', $client))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_update_client()
    {
        $user = factory(User::class)->states('unacceptable')->create();
        $client = factory(Client::class)->create();

        $this->actingAs($user)
            ->put(route('clients.update', $client))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function employee_can_not_update_a_client()
    {
        $client = factory(Client::class)->create();
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->put(route('clients.update', $client))
            ->assertForbidden();
    }

    /** @test */
    public function guest_can_not_visit_update_client_page()
    {
        $client = factory(Client::class)->create();

        $this->get(route('clients.edit', $client))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_can_not_visit_update_client_page()
    {
        $user = factory(User::class)->states('employee')->create();
        $client = factory(Client::class)->create();

        $this->actingAs($user)
            ->get(route('clients.edit', $client))
            ->assertForbidden();
    }

    /** @test */
    public function admin_can_visit_update_client_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $client = factory(Client::class)->create();

        $this->actingAs($admin)
            ->get(route('clients.edit', $client))
            ->assertSuccessful()
            ->assertViewIs('clients.edit');
    }

    /** @test */
    public function admin_can_update_a_client()
    {
        $file = UploadedFile::fake()->image('logo.jpg');

        $client = factory(Client::class)->create();
        $admin = factory(User::class)->states('admin')->create();
        $updatedClient = factory(Client::class)->make(['logo' => $file]);

        Storage::fake('public');
        Image::shouldReceive('make->fit->save')->once();

        $this->actingAs($admin)
            ->put(route('clients.update', $client), $updatedClient->toArray())
            ->assertSessionHas('status', 'The team was successfully updated!');

        $updatedClient->logo = 'logos/'.$file->hashName();

        $this->assertDatabaseHas('clients', $updatedClient->toArray());
        Storage::disk('public')->assertExists('logos/'.$file->hashName());
    }

    /** @test */
    public function admin_can_update_a_client_tags()
    {
        $client = factory(Client::class)->create();
        $tag = factory(Tag::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $updatedClient = factory(Client::class)->make()->makeHidden('logo')->toArray();
        $updatedClient['tags'] = [$tag->id];

        $this->actingAs($admin)
            ->put(route('clients.update', $client), $updatedClient)
            ->assertSessionHas('status', 'The team was successfully updated!');

        $this->assertCount(1, $tag->clients);
    }

    /** @test */
    public function client_name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $client = factory(Client::class)->create();

        $this->actingAs($admin)
            ->from(route('clients.edit', $client))
            ->put(route('clients.update', $client), ['name' => null])
            ->assertRedirect(route('clients.edit', $client))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function client_site_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $client = factory(Client::class)->create();

        $this->actingAs($admin)
            ->from(route('clients.edit', $client))
            ->put(route('clients.update', $client), ['site' => null])
            ->assertRedirect(route('clients.edit', $client))
            ->assertSessionHasErrors('site');
    }

    /** @test */
    public function client_description_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $client = factory(Client::class)->create();

        $this->actingAs($admin)
            ->from(route('clients.edit', $client))
            ->put(route('clients.update', $client), ['description' => null])
            ->assertRedirect(route('clients.edit', $client))
            ->assertSessionHasErrors('description');
    }

    /** @test */
    public function client_country_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $client = factory(Client::class)->create();

        $this->actingAs($admin)
            ->from(route('clients.edit', $client))
            ->put(route('clients.update', $client), ['country' => null])
            ->assertRedirect(route('clients.edit', $client))
            ->assertSessionHasErrors('country');
    }

    /** @test */
    public function country_should_be_a_valid_country_code()
    {
        $admin = factory(User::class)->states('admin')->create();
        $client = factory(Client::class)->create();

        $this->actingAs($admin)
            ->put(route('clients.update', $client), ['country' => 'wrong'])
            ->assertSessionHasErrors('country');
    }

    /** @test */
    public function logo_should_be_a_valid_image_file()
    {
        $admin = factory(User::class)->states('admin')->create();
        $client = factory(Client::class)->create();

        $this->actingAs($admin)
            ->put(route('clients.update', $client), ['logo' => 'wrong'])
            ->assertSessionHasErrors('logo');
    }
}
