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

    /**
     * Only admin can update a client.
     *
     * @return void
     */
    public function testOnlyAdminCanUpdateAClient()
    {
        $client = factory(Client::class)->create();
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->put(route('clients.update', $client->id))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->put(route('clients.update', $client->id))
            ->assertStatus(403);
    }

    /**
     * Only admin can visit edit client page.
     *
     * @return void
     */
    public function testOnlyAdminCanVisitEditClientPage()
    {
        $user = factory(User::class)->create(['is_admin' => false]);
        $client = factory(Client::class)->create();

        $this->get(route('clients.edit', $client->id))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->get(route('clients.edit', $client->id))
            ->assertStatus(403);
    }

    /**
     * Admin can visit edit client page.
     *
     * @return void
     */
    public function testAdminCanVisitEditClientPage()
    {
        $admin = factory(User::class)->states('admin')->create();
        $client = factory(Client::class)->create();

        $this->actingAs($admin)
            ->get(route('clients.edit', $client->id))
            ->assertStatus(200)
            ->assertSee('Update Client')
            ->assertSee('Delete Client')
            ->assertSee($client->name);
    }

    /**
     * Admin can update a client.
     *
     * @return void
     */
    public function testAdminCanUpdateAClient()
    {
        $client = factory(Client::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        Storage::fake('public');
        Image::shouldReceive('make->fit->save')->once();

        $inputAttributes = $this->getInputAttributes();
        $resultAttributes = $this->getResultAttributes($inputAttributes);

        $this->actingAs($admin)
            ->put(route('clients.update', $client->id), $inputAttributes)
            ->assertSessionHas('status', 'The client was successfully updated!');

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
    private function getInputAttributes()
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
    private function getResultAttributes($attributes)
    {
        $attributes['logo'] = 'logos/' . $this->file->hashName();

        return $attributes;
    }
}
