<?php

namespace App\Jobs;

use App\Client;
use App\Utilities\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Requests\UpdateClient as UpdateClientRequest;

class UpdateClient implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Client.
     *
     * @var \App\Client
     */
    private $client;

    /**
     * Client attributes.
     *
     * @var array
     */
    private $attributes;

    /**
     * Create a new job instance.
     *
     * @param  \App\Client  $client
     * @param  \App\Http\Requests\UpdateClient  $request
     * @return void
     */
    public function __construct(Client $client, UpdateClientRequest $request)
    {
        $this->client = $client;

        $this->attributes = request(['name', 'country', 'description', 'site']);

        if ($request->hasFile('logo')) {
            $this->attributes['logo'] = Image::fit($request->file('logo')->store('logos'));
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->client->update($this->attributes);
    }
}
