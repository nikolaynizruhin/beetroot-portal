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

class CreateClientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_create_a_client()
    {
        $this->post(route('clients.store'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_create_a_client()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->post(route('clients.store'))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function employee_can_not_create_a_client()
    {
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->post(route('clients.store'))
            ->assertStatus(403);
    }

    /** @test */
    public function guest_can_not_visit_create_client_page()
    {
        $this->get(route('clients.create'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_can_not_visit_create_client_page()
    {
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->get(route('clients.create'))
            ->assertStatus(403);
    }

    /** @test */
    public function admin_can_visit_create_client_page()
    {
        $user = factory(User::class)->states('admin')->create();

        $this->actingAs($user)
            ->get(route('clients.create'))
            ->assertStatus(200)
            ->assertViewIs('clients.create');
    }

    /** @test */
    public function admin_can_create_a_client()
    {
        $file = UploadedFile::fake()->image('logo.jpg');

        $admin = factory(User::class)->states('admin')->create();
        $client = factory(Client::class)->make(['logo' => $file]);

        Storage::fake('public');
        Image::shouldReceive('make->fit->save')->once();

        $this->actingAs($admin)
            ->post(route('clients.store'), $client->toArray())
            ->assertSessionHas('status', 'The team was successfully created!');

        $client->logo = 'logos/'.$file->hashName();

        $this->assertDatabaseHas('clients', $client->toArray());
        Storage::disk('public')->assertExists('logos/'.$file->hashName());
    }

    /** @test */
    public function admin_can_create_a_client_without_logo()
    {
        $admin = factory(User::class)->states('admin')->create();
        $client = factory(Client::class)->make()->makeHidden('logo');

        $this->actingAs($admin)
            ->post(route('clients.store'), $client->toArray())
            ->assertSessionHas('status', 'The team was successfully created!');

        $client->logo = Client::DEFAULT_LOGO;

        $this->assertDatabaseHas('clients', $client->toArray());
    }

    /** @test */
    public function admin_can_create_a_client_with_tags()
    {
        $admin = factory(User::class)->states('admin')->create();
        $tag = factory(Tag::class)->create();
        $client = factory(Client::class)->make()
            ->makeHidden('logo')
            ->toArray();

        $client['tags'] = [$tag->id];

        $this->actingAs($admin)
            ->post(route('clients.store'), $client)
            ->assertSessionHas('status', 'The team was successfully created!');

        $this->assertCount(1, $tag->clients);
    }

    /** @test */
    public function some_of_client_fields_are_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->post(route('clients.store'))
            ->assertSessionHasErrors([
                'name', 'country', 'description', 'site',
            ]);
    }
}
