<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ClearAvatars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'avatar:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove unused avatars';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $all = Storage::files('avatars');

        $used = User::usedAvatars();

        $unused = collect($all)->diff($used)->values();

        Storage::delete($unused->all());

        $this->info('('.$unused->count().') Unused avatars was removed successfully!');
    }
}
