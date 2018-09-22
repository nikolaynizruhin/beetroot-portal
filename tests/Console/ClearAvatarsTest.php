<?php

namespace Tests\Console;

use App\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClearAvatarsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_clear_unused_avatars()
    {
        Storage::fake('public');

        $unused = UploadedFile::fake()
            ->image('unused.jpg')
            ->store('avatars');

        $used = UploadedFile::fake()
            ->image('used.jpg')
            ->store('avatars');

        factory(User::class)->create(['avatar' => $used]);

        $this->artisan('avatar:clear')
            ->expectsOutput('(1) Unused avatars was removed successfully!')
            ->assertExitCode(0);

        Storage::disk('public')->assertMissing($unused);
        Storage::disk('public')->assertExists($used);
    }
}
