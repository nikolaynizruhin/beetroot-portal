<?php

namespace App\Jobs\Activities;

use App\User;
use App\Activity;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateAnniversaries
{
    use Dispatchable, Queueable;

    /**
     * Execute the job.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all()->filter->hasAnniversary();

        $users->each->recordActivity(Activity::ANNIVERSARY);

        return $users->count();
    }
}
