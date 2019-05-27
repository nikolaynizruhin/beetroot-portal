<?php

namespace App\Console\Commands;

use App\Activity;
use Illuminate\Console\Command;

class ClearActivities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activity:clear {months=1 : Month count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear old activities';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $months = $this->argument('months');

        $activities = Activity::before(now()->subMonths($months));

        $count = $activities->count();

        $activities->delete();

        $this->info('('.$count.') Activities older than '.$months.' months was removed successfully!');
    }
}
