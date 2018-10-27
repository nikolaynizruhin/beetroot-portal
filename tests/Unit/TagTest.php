<?php

namespace Tests\Unit;

use App\Client;
use App\Tag;
use App\User;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_has_many_users()
    {
        $tag = factory(Tag::class)->create();
        $user = factory(User::class)->create();

        $tag->users()->attach($user);

        $this->assertTrue($tag->users->contains($user));
        $this->assertInstanceOf(Collection::class, $tag->users);
    }

    /** @test */
    public function it_can_has_many_clients()
    {
        $tag = factory(Tag::class)->create();
        $client = factory(Client::class)->create();

        $tag->clients()->attach($client);

        $this->assertTrue($tag->clients->contains($client));
        $this->assertInstanceOf(Collection::class, $tag->clients);
    }
}
