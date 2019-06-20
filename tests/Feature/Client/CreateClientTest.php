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
            ->assertForbidden();
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
            ->assertForbidden();
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

        Storage::fake('public');
        Image::shouldReceive('make->fit->save')->once();

        $this->actingAs($admin)
            ->post(route('clients.store'), $client = $this->validParams(['logo' => $file]))
            ->assertSessionHas('status', 'The team was successfully created!');

        $client['logo'] = 'logos/'.$file->hashName();

        $this->assertDatabaseHas('clients', $client);
        Storage::disk('public')->assertExists('logos/'.$file->hashName());
    }

    /** @test */
    public function admin_can_create_a_client_without_logo()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->post(route('clients.store'), $client = $this->validParams())
            ->assertSessionHas('status', 'The team was successfully created!');

        $client['logo'] = Client::DEFAULT_LOGO;

        $this->assertDatabaseHas('clients', $client);
    }

    /** @test */
    public function admin_can_create_a_client_with_tags()
    {
        $admin = factory(User::class)->states('admin')->create();
        $tag = factory(Tag::class)->create();

        $this->actingAs($admin)
            ->post(route('clients.store'), $this->validParams(['tags' => [$tag->id]]))
            ->assertSessionHas('status', 'The team was successfully created!');

        $this->assertCount(1, $tag->clients);
    }

    /** @test */
    public function client_name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->from(route('clients.create'))
            ->post(route('clients.store'), $this->validParams(['name' => null]))
            ->assertRedirect(route('clients.create'))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function client_country_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->from(route('clients.create'))
            ->post(route('clients.store'), $this->validParams(['country' => null]))
            ->assertRedirect(route('clients.create'))
            ->assertSessionHasErrors('country');
    }

    /** @test */
    public function client_description_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->from(route('clients.create'))
            ->post(route('clients.store'), $this->validParams(['description' => null]))
            ->assertRedirect(route('clients.create'))
            ->assertSessionHasErrors('description');
    }

    /** @test */
    public function client_site_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->from(route('clients.create'))
            ->post(route('clients.store'), $this->validParams(['site' => null]))
            ->assertRedirect(route('clients.create'))
            ->assertSessionHasErrors('site');
    }

    /** @test */
    public function country_should_be_a_valid_country_code()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->post(route('clients.store'), $this->validParams(['country' => 'wrong']))
            ->assertSessionHasErrors('country');
    }

    /**
     * Get valid client params.
     *
     * @param  array  $overrides
     * @return array
     */
    private function validParams($overrides = [])
    {
        $client = factory(Client::class)
            ->make()
            ->makeHidden('logo')
            ->toArray();

        return array_merge($client, $overrides);
    }
}
