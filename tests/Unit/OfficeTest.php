<?php

namespace Tests\Unit;

use App\User;
use App\Office;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OfficeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_office_has_many_users()
    {
        $office = factory(Office::class)->create();
        $user = factory(User::class)->create(['office_id' => $office->id]);

        $this->assertTrue($office->users->contains($user));
        $this->assertInstanceOf(Collection::class, $office->users);
    }
}
