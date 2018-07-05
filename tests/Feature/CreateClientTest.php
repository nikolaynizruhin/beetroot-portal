<?php

namespace Tests\Feature;

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
        $admin = factory(User::class)->states('admin')->create();
        $client = factory(Client::class)->make()->toArray();

        $file = UploadedFile::fake()->image('logo.jpg');

        Storage::fake('public');
        Image::shouldReceive('make->fit->save')->once();

        $input = $this->input($client, $file);
        $result = $this->result($client, $file);

        $this->actingAs($admin)
            ->post(route('clients.store'), $input)
            ->assertSessionHas('status', 'The client was successfully created!');

        $this->assertDatabaseHas('clients', $result);

        Storage::disk('public')->assertExists('logos/'.$file->hashName());
    }

    /** @test */
    public function admin_can_create_a_client_without_logo()
    {
        $admin = factory(User::class)->states('admin')->create();
        $client = factory(Client::class)->make()
            ->makeHidden('logo')
            ->toArray();

        $input = $this->input($client);
        $result = $this->result($client);

        $this->actingAs($admin)
            ->post(route('clients.store'), $input)
            ->assertSessionHas('status', 'The client was successfully created!');

        $this->assertDatabaseHas('clients', $result);
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

    /**
     * Get input attributes.
     *
     * @param  array  $client
     * @param  object|null  $file
     * @return array
     */
    private function input($client, $file = null)
    {
        if ($file) {
            $client['logo'] = $file;
        }

        return $client;
    }

    /**
     * Get result attributes.
     *
     * @param  array  $client
     * @param  object|null  $file
     * @return array
     */
    private function result($client, $file = null)
    {
        $client['logo'] = $file ? 'logos/'.$file->hashName() : Client::DEFAULT_LOGO;

        return $client;
    }
}
