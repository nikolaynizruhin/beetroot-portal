<?php

namespace Tests\Unit;

use App\User;
use App\Office;
use App\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User has a client.
     *
     * @return void
     */
    public function testUserHasAClient()
    {
        $user = factory(User::class)->create();
        $client = Client::first();

        $this->assertInstanceOf(Client::class, $user->client);
        $this->assertEquals($user->client->id, $client->id);
    }

    /**
     * User has a office.
     *
     * @return void
     */
    public function testUserHasAnOffice()
    {
        $user = factory(User::class)->create();
        $office = Office::first();

        $this->assertInstanceOf(Office::class, $user->office);
        $this->assertEquals($user->office->id, $office->id);
    }

    /**
     * User can be an admin.
     *
     * @return void
     */
    public function testUserCanBeAnAdmin()
    {
        $user = factory(User::class)->states('admin')->create();

        $this->assertTrue($user->is_admin);
    }

    /**
     * User can determine avatar.
     *
     * @return void
     */
    public function testUserCanDetermineAvatar()
    {
        $user = factory(User::class)->create();

        $this->assertEquals('avatars/default.jpg', $user->avatar);

        $user->avatar = 'avatars/me.jpg';

        $this->assertEquals('avatars/me.jpg', $user->avatar);
    }
}
