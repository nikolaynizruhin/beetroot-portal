<?php

namespace Tests\Feature\Activity;

use App\User;
use App\Client;
use App\Office;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TriggerActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creating_a_user()
    {
        $user = factory(User::class)->create();

        $this->assertCount(1, $user->activities);
        $this->assertEquals('created_user', $user->activities->last()->name);
    }

    /** @test */
    public function creating_a_client()
    {
        $client = factory(Client::class)->create();

        $this->assertCount(1, $client->activities);
        $this->assertEquals('created_client', $client->activities->last()->name);
    }

    /** @test */
    public function creating_an_office()
    {
        $office = factory(Office::class)->create();

        $this->assertCount(1, $office->activities);
        $this->assertEquals('created_office', $office->activities->last()->name);
    }
}
