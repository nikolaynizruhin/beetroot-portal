<?php

namespace Tests\Unit;

use App\Tag;
use App\User;
use App\Client;
use Tests\TestCase;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_many_users()
    {
        $client = factory(Client::class)->create();
        $user = factory(User::class)->create(['client_id' => $client->id]);

        $this->assertTrue($client->users->contains($user));
        $this->assertInstanceOf(Collection::class, $client->users);
    }

    /** @test */
    public function it_can_determine_a_logo()
    {
        $client = factory(Client::class)->create();

        $this->assertEquals('logos/default.png', $client->logo);

        $client->logo = 'logos/new.jpg';

        $this->assertEquals('logos/new.jpg', $client->logo);
    }

    /** @test */
    public function it_can_has_many_tags()
    {
        $client = factory(Client::class)->create();
        $tag = factory(Tag::class)->create();

        $client->syncTags($tag);

        $this->assertTrue($client->tags->contains($tag));
        $this->assertInstanceOf(Collection::class, $client->tags);
    }

    /** @test */
    public function it_can_check_whatever_logo_is_not_default()
    {
        Image::shouldReceive('make->fit->save')->once();

        $client = factory(Client::class)->create(['logo' => 'path/to/logo.jpg']);

        $this->assertTrue($client->hasNoDefaultImage());
    }

    /** @test */
    public function it_can_get_used_logos()
    {
        $client = factory(Client::class)->create();

        $this->assertEquals([Client::DEFAULT_LOGO], Client::usedLogos()->all());
    }

    /** @test */
    public function it_can_get_countries_list()
    {
        $client = factory(Client::class)->create(['country' => 'Egypt']);

        $this->assertEquals(['Egypt'], Client::countries()->all());
    }

    /** @test */
    public function it_should_not_optimize_default_logo_when_client_created()
    {
        Image::shouldReceive('make->fit->save')->never();

        factory(Client::class)->create();
    }

    /** @test */
    public function it_should_not_optimize_default_logo_when_client_updated()
    {
        Image::shouldReceive('make->fit->save')->never();

        $client = factory(Client::class)->create();

        $client->update(['name' => 'Alliance']);
    }

    /** @test */
    public function it_should_optimize_logo_when_client_created()
    {
        Image::shouldReceive('make->fit->save')->once();

        factory(Client::class)->create(['logo' => 'path/to/logo.jpg']);
    }

    /** @test */
    public function it_should_optimize_logo_when_client_updated()
    {
        Image::shouldReceive('make->fit->save')->once();

        $client = factory(Client::class)->create();

        $client->update(['logo' => 'path/to/logo.jpg']);
    }

    /** @test */
    public function it_should_not_delete_default_logo_if_client_deleted()
    {
        Image::shouldReceive('make->fit->save')->never();

        $client = factory(Client::class)->create();

        $client->delete();
    }

    /** @test */
    public function it_should_delete_logo_if_client_deleted()
    {
        Image::shouldReceive('make->fit->save')->once();

        Storage::shouldReceive('delete')
            ->once()
            ->with('path/to/logo.jpg')
            ->andReturn(true);

        $client = factory(Client::class)->create(['logo' => 'path/to/logo.jpg']);

        $client->delete();
    }
}
