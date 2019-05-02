<?php

namespace App\Jobs\Activities;

use App\User;
use App\Activity;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateAnniversaries implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
