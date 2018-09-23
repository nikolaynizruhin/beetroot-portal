<?php

namespace Tests\Feature;

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

    /**
     * Logo file.
     *
     * @var object
     */
    private $file;

    /**
     * Setup.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->file = UploadedFile::fake()->image('logo.jpg');
    }

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
            ->assertStatus(403);
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
            ->assertStatus(403);
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
        $client = factory(Client::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        Storage::fake('public');
        Image::shouldReceive('make->fit->save')->once();

        $this->actingAs($admin)
            ->put(route('clients.update', $client), $input = $this->input())
            ->assertSessionHas('status', 'The team was successfully updated!');

        $this->assertDatabaseHas('clients', $this->result($input));

        Storage::disk('public')->assertExists('logos/'.$this->file->hashName());
    }

    /** @test */
    public function some_of_client_fields_are_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $client = factory(Client::class)->create();

        $this->actingAs($admin)
            ->put(route('clients.update', $client))
            ->assertSessionHasErrors(['name', 'country', 'description', 'site']);
    }

    /**
     * Get input client attributes.
     *
     * @return array
     */
    private function input()
    {
        $client = factory(Client::class)->make(['logo' => $this->file])->toArray();

        return $client;
    }

    /**
     * Get result client attributes.
     *
     * @param  array  $client
     * @return array
     */
    private function result($client)
    {
        $client['logo'] = 'logos/'.$this->file->hashName();

        return $client;
    }
}
