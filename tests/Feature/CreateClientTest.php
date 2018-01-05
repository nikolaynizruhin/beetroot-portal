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
    public function guest_can_not_create_a_client()
    {
        $this->post(route('clients.store'))
            ->assertRedirect('login');
    }

    /** @test */
    public function employee_can_not_create_a_client()
    {
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($user)
            ->post(route('clients.store'))
            ->assertStatus(403);
    }

    /** @test */
    public function guest_can_not_visit_create_client_page()
    {
        $this->get(route('clients.create'))
            ->assertRedirect('login');
    }

    /** @test */
    public function employee_can_not_visit_create_client_page()
    {
        $user = factory(User::class)->create(['is_admin' => false]);

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
            ->assertSee('Add Client');
    }

    /** @test */
    public function admin_can_create_a_client()
    {
        $admin = factory(User::class)->states('admin')->create();

        Storage::fake('public');
        Image::shouldReceive('make->fit->save')->once();

        $input = $this->inputAttributes();
        $result = $this->resultAttributes($input);

        $this->actingAs($admin)
            ->post(route('clients.store'), $input)
            ->assertSessionHas('status', 'The client was successfully created!');

        $this->assertDatabaseHas('clients', $result);

        Storage::disk('public')->assertExists('logos/'.$this->file->hashName());
    }

    /** @test */
    public function some_of_client_fields_are_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->post(route('clients.store'))
            ->assertSessionHasErrors([
                'name', 'logo', 'country', 'description', 'site',
            ]);
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
     * @param  array $attributes
     * @return array
     */
    private function resultAttributes($attributes)
    {
        $attributes['logo'] = 'logos/'.$this->file->hashName();

        return $attributes;
    }
}
