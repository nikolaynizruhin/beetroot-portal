<?php

namespace Tests\Unit;

use App\Tag;
use App\User;
use App\Client;
use App\Office;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_client()
    {
        $user = factory(User::class)->create();
        $client = Client::first();

        $this->assertInstanceOf(Client::class, $user->client);
        $this->assertEquals($user->client->id, $client->id);
    }

    /** @test */
    public function it_has_an_office()
    {
        $user = factory(User::class)->create();
        $office = Office::first();

        $this->assertInstanceOf(Office::class, $user->office);
        $this->assertEquals($user->office->id, $office->id);
    }

    /** @test */
    public function it_can_be_an_admin()
    {
        $user = factory(User::class)->states('admin')->create();

        $this->assertTrue($user->is_admin);
    }

    /** @test */
    public function it_can_determine_an_avatar()
    {
        $user = factory(User::class)->create();

        $this->assertEquals('avatars/default.png', $user->avatar);

        $user->avatar = 'avatars/me.jpg';

        $this->assertEquals('avatars/me.jpg', $user->avatar);
    }

    /** @test */
    public function it_has_a_month_and_day_of_birth_attribute()
    {
        $user = factory(User::class)->create(['birthday' => '2000-01-01']);

        $this->assertEquals($user->month_and_day_of_birth, '0101');
    }

    /** @test */
    public function it_has_a_name_of_the_month_of_birth_attribute()
    {
        $user = factory(User::class)->create(['birthday' => '2000-01-01']);

        $this->assertEquals($user->month_name_of_birth, 'January');
    }

    /** @test */
    public function it_can_fetch_employees_by_position()
    {
        $user = factory(User::class)->create();

        $this->assertTrue(User::ofPosition($user->position)->get()->contains($user));
    }

    /** @test */
    public function it_can_accept_privacy_policy()
    {
        $user = factory(User::class)->create(['accepted_at' => null]);

        $user->accept();

        $this->assertNotNull($user->accepted_at);
    }

    /** @test */
    public function it_can_has_many_tags()
    {
        $user = factory(User::class)->create();
        $tag = factory(Tag::class)->create();

        $user->tags()->attach($tag);

        $this->assertTrue($user->tags->contains($tag));
        $this->assertInstanceOf(Collection::class, $user->tags);
    }

    /** @test */
    public function it_can_check_whatever_avatar_is_default()
    {
        $user = factory(User::class)->create(['avatar' => User::DEFAULT_AVATAR]);

        $this->assertTrue($user->hasDefaultAvatar());
    }
}
