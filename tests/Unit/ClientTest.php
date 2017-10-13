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

    /**
     * Client has many users.
     *
     * @return void
     */
    public function testClientHasManyUsers()
    {
        $client = factory(Client::class)->create();
        $user = factory(User::class)->create(['client_id' => $client->id]);

        $this->assertTrue($client->users->contains($user));
        $this->assertInstanceOf(Collection::class, $client->users);
    }

    /**
     * Client can determine logo.
     *
     * @return void
     */
    public function testClientCanDetermineLogo()
    {
        $client = factory(Client::class)->create();

        $this->assertEquals('logos/default.png', $client->logo);

        $client->logo = 'logos/new.jpg';

        $this->assertEquals('logos/new.jpg', $client->logo);
    }
}
