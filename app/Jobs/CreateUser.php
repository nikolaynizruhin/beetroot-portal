<?php

namespace App\Jobs;

use App\User;
use App\Utilities\Image;
use Illuminate\Bus\Queueable;
use App\Http\Requests\StoreUser;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * User attributes.
     *
     * @var array
     */
    private $attributes;

    /**
     * Create a new job instance.
     *
     * @param  \App\Http\Requests\StoreUser  $request
     * @return void
     */
    public function __construct(StoreUser $request)
    {
        $this->attributes = request(['name', 'email', 'position', 'birthday', 'phone', 'bio', 'slack', 'skype', 'github', 'client_id', 'office_id']);

        $this->attributes['avatar'] = Image::fit($request->file('avatar')->store('avatars'));
        $this->attributes['remember_token'] = str_random(10);
        $this->attributes['is_admin'] = (bool) $request->is_admin;
        $this->attributes['password'] = bcrypt($request->password);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        User::create($this->attributes);
    }
}
