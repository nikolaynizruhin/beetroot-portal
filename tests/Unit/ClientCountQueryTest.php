<?php

namespace Tests\Unit;

use App\Client;
use Tests\TestCase;
use App\Queries\ClientCountQuery;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientCountQueryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_client_count()
    {
        $client = factory(Client::class)->create();

        $collection = resolve(ClientCountQuery::class)();

        $this->assertEquals($collection->first()->country, $client->country);
        $this->assertEquals($collection->first()->count, 1);
    }
}
