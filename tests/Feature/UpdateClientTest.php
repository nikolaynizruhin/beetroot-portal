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
     * Setup
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

        $this->put(route('clients.update', $client->id))
            ->assertRedirect('login');
    }

    /** @test */
    public function employee_can_not_update_a_client()
    {
        $client = factory(Client::class)->create();
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($user)
            ->put(route('clients.update', $client->id))
            ->assertStatus(403);
    }

    /** @test */
    public function guest_can_not_visit_update_client_page()
    {
        $client = factory(Client::class)->create();

        $this->get(route('clients.edit', $client->id))
            ->assertRedirect('login');
    }

    /** @test */
    public function employee_can_not_visit_update_client_page()
    {
        $user = factory(User::class)->create(['is_admin' => false]);
        $client = factory(Client::class)->create();

        $this->actingAs($user)
            ->get(route('clients.edit', $client->id))
            ->assertStatus(403);
    }

    /** @test */
    public function admin_can_visit_update_client_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $client = factory(Client::class)->create();

        $this->actingAs($admin)
            ->get(route('clients.edit', $client->id))
            ->assertStatus(200)
            ->assertSee('Update Client')
            ->assertSee('Delete Client')
            ->assertSee($client->site);
    }

    /** @test */
    public function admin_can_update_a_client()
    {
        $client = factory(Client::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        Storage::fake('public');
        Image::shouldReceive('make->fit->save')->once();

        $input = $this->inputAttributes();
        $result = $this->resultAttributes($input);

        $this->actingAs($admin)
            ->put(route('clients.update', $client->id), $input)
            ->assertSessionHas('status', 'The client was successfully updated!');

        $this->assertDatabaseHas('clients', $result);

        Storage::disk('public')->assertExists('logos/' . $this->file->hashName());
    }

    /** @test */
    public function some_of_client_fields_are_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $client = factory(Client::class)->create();

        $this->actingAs($admin)
            ->put(route('clients.update', $client->id))
            ->assertSessionHasErrors(['name', 'country', 'description', 'site']);
    }

    /**
     * Get input attributes.
     *
     * @return array
     */
    private function inputAttributes()
    {
        $attributes = factory(Client::class)->make(['logo' => $this->file])->toArray();

        return $attributes;
    }

    /**
     * Get result attributes.
     *
     * @param  array  $attributes
     * @return array
     */
    private function resultAttributes($attributes)
    {
        $attributes['logo'] = 'logos/' . $this->file->hashName();

        return $attributes;
    }
}
