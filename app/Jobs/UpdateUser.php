<?php

namespace App\Jobs;

use App\User;
use App\Utilities\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Requests\UpdateUser as UpdateUserRequest;

class UpdateUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var \App\User $user */
    private $user;

    /** @var array $attributes */
    private $attributes;

    /**
     * Create a new job instance.
     *
     * @param  \App\User  $user
     * @param  \App\Http\Requests\UpdateUser  $request
     * @return void
     */
    public function __construct(User $user, UpdateUserRequest $request)
    {
        $this->user = $user;

        $this->attributes = request(['name', 'email', 'position', 'birthday', 'phone', 'bio', 'slack', 'skype', 'github', 'client_id', 'office_id']);

        $this->attributes['is_admin'] = (bool) $request->is_admin;

        if ($request->hasFile('avatar')) {
            $this->attributes['avatar'] = Image::fit($request->file('avatar')->store('avatars'));
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->update($this->attributes);
    }
}
