<?php

namespace App\Jobs\Activities;

use App\User;
use App\Activity;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateBirthdays
{
    use Dispatchable, Queueable;

    /**
     * Execute the job.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all()->filter->hasBirthday();

        $users->each->recordActivity(Activity::BIRTHDAY);

        return $users->count();
    }
}
