<?php

namespace App\Console\Commands;

use App\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ClearLogos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logo:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove unused logos';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $all = Storage::files('logos');

        $used = Client::usedLogos();

        $unused = collect($all)->diff($used)->values();

        Storage::delete($unused->all());

        $this->info('('.$unused->count().') Unused logos was removed successfully!');
    }
}
