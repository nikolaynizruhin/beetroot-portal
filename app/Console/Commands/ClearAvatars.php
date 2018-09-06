<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $all = Storage::files('avatars');

        $used = $this->getUsedAvatars();

        $unused = collect($all)->diff($used)->values();

        Storage::delete($unused->all());

        $this->info('('.$unused->count().') Unused avatars was removed successfully!');
    }

    /**
     * Get used avatars.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getUsedAvatars()
    {
        $used = DB::table('users')
            ->select('avatar')
            ->get()
            ->pluck('avatar');

        if (! $used->contains(User::DEFAULT_AVATAR)) {
            $used->push(User::DEFAULT_AVATAR);
        }

        return $used;
    }
}