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
     * Setup
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->file = UploadedFile::fake()->image('logo.jpg');
    }

    /**
     * Only admin can create a client.
     *
     * @return void
     */
    public function testOnlyAdminCanCreateAClient()
    {
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->post(route('clients.store'))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->post(route('clients.store'))
            ->assertStatus(403);
    }

    /**
     * Only admin can visit create a client page.
     *
     * @return void
     */
    public function testOnlyAdminCanVisitCreateAClientPage()
    {
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->get(route('clients.create'))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->get(route('clients.create'))
            ->assertStatus(403);
    }

    /**
     * Admin can visit create client page.
     *
     * @return void
     */
    public function testAdminCanVisitCreateAClientPage()
    {
        $user = factory(User::class)->states('admin')->create();

        $this->actingAs($user)
            ->get(route('clients.create'))
            ->assertStatus(200)
            ->assertSee('Add Client');
    }

    /**
     * Admin can create a client.
     *
     * @return void
     */
    public function testAdminCanCreateAClient()
    {
        $admin = factory(User::class)->states('admin')->create();

        Storage::fake('public');
        Image::shouldReceive('make->fit->save')->once();

        $inputAttributes = $this->getInputAttributes();
        $resultAttributes = $this->getResultAttributes($inputAttributes);

        $this->actingAs($admin)
            ->post(route('clients.store'), $inputAttributes)
            ->assertSessionHas('status', 'The client was successfully created!');

        $this->assertDatabaseHas('clients', $resultAttributes);

        Storage::disk('public')->assertExists('logos/' . $this->file->hashName());
    }

    /**
     * Client fields are required.
     *
     * @return void
     */
    public function testClientFieldsAreRequired()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->post(route('clients.store'))
            ->assertSessionHasErrors(['name', 'logo', 'country', 'description', 'site']);
    }

    /**
     * Get input attributes.
     *
     * @return array
     */
    private function getInputAttributes()
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
    private function getResultAttributes($attributes)
    {
        $attributes['logo'] = 'logos/' . $this->file->hashName();

        return $attributes;
    }
}
