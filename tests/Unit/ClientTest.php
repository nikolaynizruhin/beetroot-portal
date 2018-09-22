<?php

namespace Tests\Unit;

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
}
