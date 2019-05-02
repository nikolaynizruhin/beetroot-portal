<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\Activities\CreateBirthdays;
use App\Jobs\Activities\CreateAnniversaries;

class CreateActivities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activity:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create activities';

    /**
     * Activity jobs to execute.
     *
     * @var array
     */
    protected $jobs = [
        CreateAnniversaries::class,
        CreateBirthdays::class,
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Activities created:');

        foreach ($this->jobs as $job) {
            $count = $job::dispatchNow();

            $type = ltrim(class_basename($job), 'Create');

            $this->info($count.' - '.$type);
        }
    }
}
