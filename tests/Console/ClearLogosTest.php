<?php

namespace Tests\Console;

use App\Client;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClearLogosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_clear_unused_logos()
    {
        Storage::fake('public');

        Image::shouldReceive('make->fit->save')->once();

        $unused = UploadedFile::fake()
            ->image('unused.jpg')
            ->store('logos');

        $used = UploadedFile::fake()
            ->image('used.jpg')
            ->store('logos');

        factory(Client::class)->create(['logo' => $used]);

        $this->artisan('logo:clear')
            ->expectsOutput('(1) Unused logos was removed successfully!')
            ->assertExitCode(0);

        Storage::disk('public')
            ->assertMissing($unused)
            ->assertExists($used);
    }
}
