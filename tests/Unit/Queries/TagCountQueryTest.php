<?php

namespace Tests\Unit\Queries;

use App\Tag;
use App\User;
use Tests\TestCase;
use App\Queries\TagCountQuery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagCountQueryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_tag_count()
    {
        $tag = factory(Tag::class)->create();
        $user = factory(User::class)->create();

        $user->tags()->attach($tag);
        $user->client->tags()->attach($tag);

        $tags = app(TagCountQuery::class)();

        $this->assertInstanceOf(Collection::class, $tags);
        $this->assertInstanceOf(Tag::class, $tags->first());
        $this->assertEquals(1, $tags->first()->users_count);
        $this->assertEquals(1, $tags->first()->clients_count);
    }
}
