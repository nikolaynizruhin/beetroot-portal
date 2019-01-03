<?php

namespace Tests\Unit;

use App\Tag;
use App\User;
use App\Client;
use Tests\TestCase;
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
    public function it_can_check_whatever_logo_is_default()
    {
        $client = factory(Client::class)->create(['logo' => Client::DEFAULT_LOGO]);

        $this->assertTrue($client->hasDefaultLogo());
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
}
