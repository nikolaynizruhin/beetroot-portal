<?php

namespace App\Jobs;

use App\Client;
use App\Utilities\Image;
use Illuminate\Bus\Queueable;
use App\Http\Requests\StoreClient;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateClient implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Client attributes.
     *
     * @var array
     */
    private $attributes;

    /**
     * Create a new job instance.
     *
     * @param  \App\Http\Requests\StoreClient  $request
     * @return void
     */
    public function __construct(StoreClient $request)
    {
        $this->attributes = request(['name', 'country', 'description', 'site']);

        $this->attributes['logo'] = Image::fit($request->file('logo')->store('logos'));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Client::create($this->attributes);
    }
}
