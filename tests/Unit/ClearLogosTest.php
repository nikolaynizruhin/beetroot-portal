<?php

namespace Tests\Unit;

use App\Client;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClearLogosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_clear_unused_logos()
    {
        Storage::fake('public');

        $unused = UploadedFile::fake()
            ->image('unused.jpg')
            ->store('logos');

        $used = UploadedFile::fake()
            ->image('used.jpg')
            ->store('logos');

        factory(Client::class)->create(['logo' => $used]);

        $this->artisan('logo:clear')
            ->assertExitCode(0);

        Storage::disk('public')->assertMissing($unused);
        Storage::disk('public')->assertExists($used);
    }
}
